<?php

namespace M74asoud\File ;

use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider {

    public function boot() {
        //composer dump-autoload
        $this->loadMigrationsFrom( __DIR__ . '/Migrations' );
        $this->publishes([
            __DIR__ . '/Config/m74_file.php' => config_path('m74_file.php'),
        ]);
    }

    public function register() {

    }

}
