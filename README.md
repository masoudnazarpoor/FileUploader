<h1>
FileUploader
</h1>
<h5>
this package upload your file and compatible with laravel storage
</h5>


## Installation

```bash
$ composer require m74asoud/file

- change filesystem default driver to public in config/app.php

$ php artisan vendor:publish

$ php artisan storage:link
```

- SET FFPROBE - FILE_BASE_URL - ACCEPTED FILE TYPE PATH IN m74_config IN CONFIG DIRECTORY

```bash
[
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
]
```

- HOW TO USE

```bash
use M74asoud\File\Traits\FileAble;
use Illuminate\Http\UploadedFile;

class User extends Model
{
    use FileAble;
}

$user->upload(UploadedFile $file);

$file->getAbsolutePath();
$file->getTimeByMinute();
$file->getSizeByMegaByte();
$file->getType();
$file->isMedia();
$file->download();
$file->remove();
$file->link();
$file->secureLink();
```
