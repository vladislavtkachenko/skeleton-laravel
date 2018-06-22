<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Roumen\Sitemap\Sitemap;

class SiteMapGenerate extends Command
{
    protected $signature = 'site-map:generate';
    protected $description = 'Генерация карты сайта';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Sitemap $sitemap
     * @return mixed
     */
    public function handle(Sitemap $sitemap)
    {
        \Log::info('Генерация карты сайта старт');

        $sitemap->add(route('home'), Carbon::now()->toIso8601String(), '1.0', 'daily');

        $sitemap->store('xml', 'sitemap');
//        $sitemap->store('html', 'sitemap');

        \Log::info('Генерация карты сайта конец');
    }
}
