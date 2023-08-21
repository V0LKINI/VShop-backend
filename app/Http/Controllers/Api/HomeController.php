<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OfferCollection;
use App\Services\SettingService;
use App\Services\OfferService;

class HomeController extends BaseController
{
    public function __construct(
        private readonly SettingService $settingService,
        private readonly OfferService $offerService
    ) {}

    /**
     * Get data for home page
     */
    public function index()
    {
        try {
            $offers = $this->offerService->getList();
            $banner = $this->settingService->getByKey(key: 'main_banner');

            $response = [
                'offers' => OfferCollection::collection($offers),
                'settings' => [
                    'banner' => $banner
                ],
            ];

            return $this->success($response);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
