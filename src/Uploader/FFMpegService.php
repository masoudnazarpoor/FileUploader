<?php


namespace M74asoud\File\Uploader;


use FFMpeg\FFProbe;

class FFMpegService
{
    private $ffprobe;

    public function __construct()
    {
        $this->ffprobe = FFProbe::create([
            'ffprobe.binaries' => config('m74_file.ffmpeg.ffprobe.path')
        ]);
    }

    public function durationOf(string $path)
    {
        return (int)$this->ffprobe->format($path)->get('duration');
    }
}
