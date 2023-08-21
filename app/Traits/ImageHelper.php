<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

trait ImageHelper
{
    public $disk = 'public';

    /**
     * Save image in model
     *
     * @param $attribute
     * @param $folder
     * @param $value
     */
    protected function setImage($attribute, $folder, $value)
    {
        if ($value == null && $this->{$attribute}) {
            Storage::disk($this->disk)->delete($this->{$attribute});
            $this->attributes[$attribute] = null;
        }

        if (Str::startsWith($value, 'data:image')) {
            $image = ImageManagerStatic::make($value);

            $ext = Str::between($value, 'data:image/', ';');
            $filename = md5($value . time() . uniqid()) . '.' . $ext;

            Storage::put($folder . '/' . $filename, $image->stream());

            if ($this->{$attribute}) {
                Storage::disk($this->disk)->delete($this->{$attribute});
            }

            $publicDestinationPath = Str::replaceFirst('public/', '', $folder);

            $this->attributes[$attribute] = $publicDestinationPath . '/' . $filename;
        } else if (Str::startsWith($value, 'http')) {
            $this->attributes[$attribute] = $this->saveRemoteImage($value, $folder);
        } else {
            $this->attributes[$attribute] = $value;
        }
    }

    /**
     * Save image from remote url
     *
     * @param $src
     * @param $folder
     */
    protected function saveRemoteImage(string $src, string $folder)
    {
        $result = null;

        if ($src) {
            $name = $folder . '/' . substr($src, strrpos($src, '/') + 1);
            $contents = file_get_contents($src);
            $result = Storage::disk($this->disk)->put($name, $contents);
        }

        return $result ? $name : null;
    }

    /**
     * Update model images from request
     *
     * @param $entity
     * @param $folder
     */
    protected function updateImages(Model $entity, string $folder)
    {
        $images = request()->images_gallery;

        if (is_array($images)) {

            $items = [];
            $ids = [];

            foreach ($images as $img) {

                $data = [
                    'folder' => $folder ,
                    'entity_type' => class_basename($entity),
                    'image' => $img['image'],
                    'description_ru' => $img['description_ru'] ?? null,
                    'description_en' => $img['description_en'] ?? null,
                    'author_ru' => $img['author_ru'] ?? null,
                    'author_en' => $img['author_en'] ?? null,
                    'sort' => $img['sort'],
                ];

                /** @var Image $el */
                $el = Image::find($img['id']);

                if (!$el) {
                    $items[] = new Image($data);
                } else {
                    $data['image'] = str_replace(Storage::url(''), '', $data['image']);

                    $ids[] = $img['id'];

                    $el->folder = $data['folder'];
                    $el->image = $data['image'];
                    $el->description_ru = $data['description_ru'] ?? null;
                    $el->description_en = $data['description_en'] ?? null;
                    $el->author_ru = $data['author_ru'] ?? null;
                    $el->author_en = $data['author_en'] ?? null;
                    $el->sort = $data['sort'];
                    $el->save();
                }
            }

            $deleteImages = Image::query()
                ->where('entity_id', $entity->id)
                ->where('entity_type', class_basename($entity))
                ->whereNotIn('id', $ids)
                ->get();

            foreach ($deleteImages as $deleteImage) {
                Storage::disk($this->disk)->delete($deleteImage->image);
                $deleteImage->delete();
            }

            $entity->images()->saveMany($items);
        }

        if (!$images) {
            foreach ($entity->images as $deleteImage) {
                Storage::disk($this->disk)->delete($deleteImage->image);
                $deleteImage->delete();
            }
        }
    }

    /**
     * Delete model images
     *
     * @param $entity
     */
    protected function deleteImages(Model $entity)
    {
        $images = Image::query()
            ->where('entity_type', class_basename($entity))
            ->where('entity_id', $entity->id)
            ->get(['id', 'image']);

        foreach ($images as $image) {
            Storage::disk($this->disk)->delete($image->image);
            $image->delete();
        }
    }
}
