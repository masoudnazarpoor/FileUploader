<?php

namespace M74asoud\File;

use Illuminate\Support\ServiceProvider;
use M74asoud\File\Models\File;
use M74asoud\File\Observers\FileObserver;

class FileServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadMigrationsFrom( __DIR__ . '/Migrations' );
        $this->publishes( [
            __DIR__ . '/Config/m74_file.php' => config_path( 'm74_file.php' ),
        ] );

        File::observe( FileObserver::class );
    }

    public function register() {

    }

}
