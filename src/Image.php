<?php

namespace TitashGallery;

class Image
{

    // Path to the file
    protected $imageFile;

    // Resource of an loaded image (typically by GD)
    protected $res;

    public function __construct($file)
    {
        self::loadFromFile($file);
    }

    /**
    * Load a file into resource $res.
    */
    protected function loadFromFile($filename)
    {
        if (!is_string($filename)) {
            throw new \InvalidArgumentException;
        }

        if (!file_exists($filename)) {
            throw new \DomainException("File $filename not found.");
        }

        $this->imageFile = $filename;

        if (!extension_loaded('gd')) {
            throw new \LogicException('PHP GD extension is missing.');
        }

        $ext = pathinfo($this->imageFile, PATHINFO_EXTENSION);
        switch ($ext) {
            case 'gif':
                $this->res = @imagecreatefromgif($this->imageFile);
                break;
            case 'jpg':
            case 'jpeg':
                $this->res = @imagecreatefromjpeg($this->imageFile);
                break;
            case 'png':
                $this->res = @imagecreatefrompng($this->imageFile);
                break;
            default:
                throw new \DomainException("File extension is unsupported.");
                break;
        }

    }
}
