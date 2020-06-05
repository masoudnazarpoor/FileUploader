<?php

return [
    'ffmpeg'          => [
        'ffprobe' => [
            'path' => '****'
        ],
    ],
    'FILE_URL_PREFIX' => ( env( 'FILE_URL_PREFIX', env( 'APP_URL' ) . '/storage' ) ),
 ];
