<?php

namespace Cirruslab\LaravelContentArea;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Blade;

class ContentAreaServiceProvider extends ServiceProvider
{

    public function boot()
    {   
        Blade::directive('content_area', function ($area_name) {
            return "<?php echo \Cirruslab\LaravelContentArea\ContentArea::firstOrCreate(['name' => {$area_name}], ['content' => '<p>Enter your content here...</p>'])->getContent(); ?>";
        });

        Route::post('/save-content-area', 'Cirruslab\LaravelContentArea\ContentAreaController@save');

        $this->loadMigrationsFrom(__DIR__.'/../condatabase/migrations');

        $this->publishes([__DIR__.'/../resources/assets/js/ckeditor' => public_path('js/ckeditor')], 'contentarea');

        $this->publishes([__DIR__.'/../config/contentarea.php' => config_path('contentarea.php')], 'contentarea');
    }

    public function register()
    {
        //
    }
}
