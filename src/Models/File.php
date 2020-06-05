<?php

namespace M74asoud\File\Models;

use M74asoud\File\Uploader\StorageManager;
use Illuminate\Database\Eloquent\Model;

class File extends Model {

    const MEDIA_TYPES = [ 'video', 'audio' ];

    private $storageManager;

    public function __construct( array $attributes = [] ) {
        parent::__construct( $attributes );
        $this->storageManager = resolve( StorageManager::class );
    }

    protected $fillable = [ 'name', 'size', 'type', 'time' ];


    public function isMedia() {
        return in_array( $this->type, self::MEDIA_TYPES );
    }

    public function getAbsolutePath() {
        return $this->storageManager->getAbsolutePathOf(
            $this->name, $this->type, $this->is_private
        );
    }


    public function getSizeByMegaByte() {
        return $this->size / ( 1024 * 1024 );
    }

    public function getTimeByMinute() {
        if ( $this->isMedia() ) {
            return $this->time / 60;
        }

        return null;
    }

    public function download() {
        return $this->storageManager->getFile( $this->name, $this->type );
    }

    public function remove() {
        $this->storageManager->removeFile( $this->name, $this->type );
        parent::delete();
    }

    public function link() {
        $storageManager = new StorageManager();

        return $storageManager->getLink( $this->name, $this->type );
    }

    public function user() {
        return $this->belongsTo( \App\User::class );
    }

}
