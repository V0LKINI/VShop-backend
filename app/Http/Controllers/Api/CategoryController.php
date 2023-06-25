<?php

namespace App\Http\Controllers\Api;

use App\Models\CategoryGroup;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    /**
     * Список категорий
     */
    public function list(): JsonResponse
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

        return $this->success($categories);
    }

}
