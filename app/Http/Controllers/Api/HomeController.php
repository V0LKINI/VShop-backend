<?php

namespace App\Http\Controllers\Api;

use App\Services\SettingsService;

class HomeController extends BaseController
{
    public function __construct(private readonly SettingsService $settingsService) {}

    /**
     * Get data for home page
     */
    public function index()
    {
        try {
            $banner = $this->settingsService->getByKey(key: 'main_banner');

            $response = [
                'settings' => [
                    'banner' => $banner
                ],
            ];

            return $this->success($response);
        } catch (\Exception $e) {
            return $this->error('Сервис временно недоступен. Мы уже работаем над его восстановлением.');
        }
    }
}
