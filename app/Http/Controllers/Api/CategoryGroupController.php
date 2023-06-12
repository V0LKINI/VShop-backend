<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\CategoryGroup;
use Illuminate\Http\Request;

class CategoryGroupController extends BaseController
{
    /**
     * Список категорий
     */
    public function list()
    {
        $categories = CategoryGroup::where('active', true)
            ->orderBy('sort')
            ->get(['id', 'name', 'code']);

        return $this->success($categories);
    }

}
