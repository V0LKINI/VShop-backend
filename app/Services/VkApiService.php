<?php

namespace App\Services;

use App\Models\Recipe;
use Exception;

class VkApiService
{
    protected $ownerId = -155180215;
    protected $apiVersion;
    protected $accessToken;

    function __construct() {
        $this->apiVersion = env('VK_API_VERSION');
        $this->accessToken = env('VK_API_ACCESS_TOKEN');
    }

    public function wallSearch($query, $count = 20) {
        $params = array(
            'v' => $this->apiVersion,
            'access_token' => $this->accessToken,
            'owner_id' => $this->ownerId,
            'count' => $count,
            'query' => $query,
        );

        $result = $this->send('wall.search', $params);

        if ($result !== false) {
            return $result->items;
        }
        else {
            return false;
        }
    }

    public function updatePostsDB() {
        $posts = $this->wallSearch('#mangiamo_e_studiamo', 100);

        $data = [];
        foreach ($posts as $post) {

            if (isset($post->attachments[0]->photo->sizes[5]->url)) {
                $imageUrl = ImagesService::cropRemoteImage(
                    url: $post->attachments[0]->photo->sizes[5]->url,
                    folder: 'posts',
                    width: 1150,
                    height: 1080,
                    x0: 0,
                    y0: 0,
                );
            }

            $data[] = [
                'id' => $post->id,
                'text' => $post->text,
                'comments_count' => $post->comments->count,
                'likes_count' => $post->likes->count,
                'reposts_count' => $post->reposts->count,
                'views_count' => $post->views->count,
                'image' => $imageUrl,
                'created_at' => date('Y-m-d H:i:s', $post->date),
            ];
        }

        Recipe::upsert($data, ['id'], ['text', 'comments_count', 'likes_count', 'reposts_count', 'views_count', 'image', 'created_at']);
    }



    protected function send($method, $params) {
        if (!$content = @file_get_contents('https://api.vk.com/method/'.$method.'?' . http_build_query($params))) {
            $error = error_get_last();
            throw new Exception('HTTP request failed. Error: ' . $error['message']);
        }

        $response = json_decode($content);

        // Если возникла ошибка
        if (isset($response->error)) {
            throw new Exception('При отправке запроса к API VK возникла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
        }

        return $response->response;
    }
}
