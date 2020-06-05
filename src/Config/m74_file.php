<?php

return [
    'ffmpeg'         => [
        'ffprobe' => [
            'path' => '****'
        ],
    ],
    'file-base-url'  => env(
        'FILE_BASE_URL',
        env( 'APP_URL' ) . '/storage'
    ),
    'accepted_types' => [
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
    ]
];
