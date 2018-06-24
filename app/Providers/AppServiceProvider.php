<?php

namespace App\Providers;

use App\Models\Config;
use App\Services\PageServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(\Schema::hasTable('configs')){
            try {
                \View::share('configs', cache()->rememberForever('configs', function () { return Config::all(); }));
            } catch (\Exception $e) { \Log::error($e->getMessage()); }
        }

        $this->app->singleton(PageServices::class, function(){
            return new PageServices();
        });



        \Blade::directive('svg', function ($arguments) {
            list($path, $class) = array_pad(explode(',', trim($arguments, "() ")), 2, '');
            $path = trim($path, "' ");
            $class = trim($class, "' ");
            $svg = new \DOMDocument();
            $svg->load(public_path($path));
            $svg->documentElement->setAttribute("class", $class);
            $output = $svg->saveXML($svg->documentElement);
            return $output;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
