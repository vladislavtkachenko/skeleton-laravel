<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Str;

class PageServices
{
    /**
     * Страница по тайтлу
     *
     * @param string $title
     * @return Page
     */
    public function getPage($title) : Page
    {
        try {
            $page = cache()->rememberForever(Str::slug($title), function () use ($title) {
                return Page::whereTitle($title)->with('seo')->first();
            });
        } catch (\Exception $e) { \Log::error($e->getMessage()); }

        return $page;
    }
}
