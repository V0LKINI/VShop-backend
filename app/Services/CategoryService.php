<?php

namespace App\Services;

use App\Models\CategoryGroup;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Get categories list
     */
    public function getList(): null | Collection
    {
        $categories = CategoryGroup::query()
            ->with(['categories' => function($query) {
                $query->where('active', true)
                    ->orderBy('sort')
                    ->select('id', 'category_group_id', 'name', 'code');
            }])
            ->where('active', true)
            ->orderBy('sort')
            ->get(['id', 'name', 'code']);

        return $categories;
    }
}
