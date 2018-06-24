<?php

namespace Admin\Providers;

use Admin\Http\Sections\Configs;
use Admin\Http\Sections\Contacts;
use Admin\Http\Sections\Pages;
use Admin\Http\Sections\Users;
use App\Models\Config;
use App\Models\Contact;
use App\Models\Page;
use App\Models\User;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use SleepingOwl\Admin\Contracts\Navigation\NavigationInterface;
use SleepingOwl\Admin\Contracts\Template\MetaInterface;
use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;

class AdminSectionsServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $widgets = [];

    /**
     * @var array
     */
    protected $sections = [
        Config::class => Configs::class,
        Page::class => Pages::class,
        User::class => Users::class,
        Contact::class => Contacts::class,
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
        $this->loadViewsFrom( base_path( "admin/resources/views" ), 'admin' );
        $this->registerPolicies( 'Admin\\Policies\\' );

        $this->app->call( [ $this, 'registerRoutes' ] );
        $this->app->call( [ $this, 'registerNavigation' ] );

        parent::boot( $admin );

        $this->app->call( [ $this, 'registerViews' ] );
        $this->app->call( [ $this, 'registerMediaPackages' ] );
    }

    /**
     * @param NavigationInterface $navigation
     */
    public function registerNavigation( NavigationInterface $navigation ) {
        require base_path( 'admin/navigation.php' );
    }

    /**
     * @param WidgetsRegistryInterface $widgetsRegistry
     */
    public function registerViews( WidgetsRegistryInterface $widgetsRegistry ) {
        foreach ( $this->widgets as $widget ) {
            $widgetsRegistry->registerWidget( $widget );
        }
    }

    /**
     * @param Router $router
     */
    public function registerRoutes( Router $router ) {
        $router->group( [
            'prefix'     => config( 'sleeping_owl.url_prefix' ),
            'middleware' => config( 'sleeping_owl.middleware' )
        ], function ( $router ) {
            require base_path( 'admin/routes.php' );
        } );
    }

    /**
     * @param MetaInterface $meta
     */
    public function registerMediaPackages( MetaInterface $meta ) {
        $packages = $meta->assets()->packageManager();
        require base_path( 'admin/assets.php' );
    }
}
