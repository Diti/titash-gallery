<?php

namespace TitashGallery;

class Image
{
    const ERR_FILE_NOT_FOUND = 404;
    const ERR_FILETYPE_UNSUPPORTED = 415;
    const ERR_FEATURE_UNAVAILABLE = 503;

    // Path to the file
    protected $filename;

    // Resource of an loaded image (typically by GD)
    protected $res;

    public function __construct($file)
    {
        self::loadFromFile($file);
    }

    protected function loadFromFile($filename)
    {
        if (!file_exists($filename)) {
            throw new \Exception("File $filename not found.", self::ERR_FILE_NOT_FOUND);
        }

        $this->filename = $filename;

        if (!extension_loaded('gd')) {
            throw new \Exception('The PHP GD extension is missing.', self::ERR_FEATURE_UNAVAILABLE);
        }

        switch (pathinfo($this->filename, PATHINFO_EXTENSION)) {
            case 'gif':
                $this->res = @imagecreatefromgif($this->filename);
                break;
            case 'jpg':
            case 'jpeg':
                $this->res = @imagecreatefromjpeg($this->filename);
                break;
            case 'png':
                $this->res = @imagecreatefrompng($this->filename);
                break;
            default:
                throw new \Exception('File ' . pathinfo($this->filename, PATHINFO_BASENAME) . ' has an unsupported extension.', self::ERR_FILETYPE_UNSUPPORTED);
                break;
        }

    }
}
