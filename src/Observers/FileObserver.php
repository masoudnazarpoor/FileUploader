<?php

namespace M74asoud\File\Observers;

use Illuminate\Support\Str;
use M74asoud\File\Models\File;

class FileObserver {

    public function created( File $file ) {
        $file->update( [ 'hash' => Str::uuid() ] );
    }

    public function deleted( File $file ) {
        $file->remove();
    }

}
