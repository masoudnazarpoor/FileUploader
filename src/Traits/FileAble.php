<?php


namespace M74asoud\File\Traits;


use Illuminate\Http\UploadedFile;
use M74asoud\File\Models\File;
use M74asoud\File\Uploader\Uploader;

trait FileAble {

    public function upload( UploadedFile $file ): File {
        return ( new Uploader() )->upload( $file, $this );
    }

    public function files() {
        return $this->morphMany( File::class, 'fileable' );
    }
}
