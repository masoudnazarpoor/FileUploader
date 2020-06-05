<?php


namespace M74asoud\File\Uploader;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageManager {


    public function storeFile( string $name, UploadedFile $file, string $type ) {
        return $this->disk()->putFileAs( $type, $file, $name );
    }

    private function disk() {
        return Storage::disk(
            config( 'filesystems.default' )
        );
    }

    public function getLink( string $name, string $type ) {
        return config( 'm74_file.file-base-url' ) . '/' . $this->directoryPrefix( $type, $name );
    }

    public function getAbsolutePathOf( string $name, string $type ) {
        return $this->disk()->path( $this->directoryPrefix( $type, $name ) );
    }

    public function isFileExists( string $name, string $type ) {

        return $this->disk()->exists( $this->directoryPrefix( $type, $name ) );

    }

    public function getFile( string $name, string $type ) {

        return $this->disk()->download( $this->directoryPrefix( $type, $name ) );

    }

    public function removeFile( string $name, string $type ) {

        return $this->disk()->delete( $this->directoryPrefix( $type, $name ) );

    }

    private function directoryPrefix( string $type, string $name ) {
        return $type . '/' . $name;
    }

    public function rename( string $name, string $type, string $newName ) {

        return $this->disk()->move(
            $this->directoryPrefix( $type, $name ),
            $this->directoryPrefix( $type, $newName )
        );

    }


}
