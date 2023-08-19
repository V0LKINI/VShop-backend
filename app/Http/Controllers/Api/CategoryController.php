<?php

namespace App\Http\Controllers\Api;

use App\Services\CategoryService;

class CategoryController extends BaseController
{
    public function __construct(private readonly CategoryService $categoryService,) {}

    /**
     * Get data for home page
     */
    public function index()
    {
        try {
            $categories = $this->categoryService->getList();
            return $this->success($categories);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
