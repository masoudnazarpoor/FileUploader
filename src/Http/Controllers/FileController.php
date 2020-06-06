<?php


namespace M74asoud\File\Http\Controllers;


use App\Http\Controllers\Controller;
use M74asoud\File\Models\File;

class FileController extends Controller {

    public function secureLink( string $hash ) {
        $file = File::where( 'hash', $hash )->firstOrFail();

        return response()->file(
            $file->getAbsolutePath()
        );
    }


}
