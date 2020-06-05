<?php


namespace M74asoud\File\Uploader;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use M74asoud\File\Exceptions\FileHasExists;
use M74asoud\File\Models\File;

class Uploader {
    private $storageManager;
    private $ffmpeg;
    private $file;

    public function __construct() {
        $this->ffmpeg         = new FFMpegService();
        $this->storageManager = new StorageManager();
    }

    public function upload( UploadedFile $file, Model $user ): File {
        $this->file = $file;

        if ( $this->isFileExists() ) {
            throw new FileHasExists();
        }
        $this->putFileIntoStorage();

        return $this->saveFileIntoFileDB( $user );
    }

    private function saveFileIntoFileDB( Model $user ) {

        $newName = Str::uuid() . '.' . $this->file->getClientOriginalExtension();
        $this->rename( $newName );

        $file = $user->files()->create( [
            'name' => $newName,
            'size' => $this->file->getSize(),
            'type' => $this->getType(),
        ] );

        $file->time = $this->getTime( $file );
        $file->save();

        return $file;
    }

    private function getTime( File $file ) {
        if ( ! $file->isMedia() ) {
            return null;
        }

        return $this->ffmpeg->durationOf( $file->getAbsolutePath() );
    }

    private function putFileIntoStorage() {

        $this->storageManager->putFileAsPublic( $this->getName(), $this->file, $this->getType() );
    }

    private function getType() {
        try {
            return [
                'image/jpg'                    => 'image',
                'image/jpeg'                   => 'image',
                'image/png'                    => 'image',
                'application/zip'              => 'archive',
                'application/x-rar-compressed' => 'archive',
                'application/x-zip-compressed' => 'archive',
                'application/octet-stream'     => 'archive',
                'video/mp4'                    => 'video',
                'application/pdf'              => 'pdf',
                'x-pdf'                        => 'pdf',
            ][ $this->file->getClientMimeType() ];
        } catch ( Exception $err ) {
            report( $err );
            abort( 403 );
        }
    }

    private function getName() {
        return $this->file->getClientOriginalName();
        //getClientOriginalExtension()
    }

    private function isFileExists() {
        return $this->storageManager->isFileExists( $this->getName(), $this->getType() );
    }

    private function rename( $newName ) {
        $this->storageManager->rename( $this->getName(), $this->getType(), $newName );
    }

}
