<?php

namespace TitashGallery;

class Image
{
    // Path to the file
    public $imageFile;

    // The image’s metadata
    private $metadata = [];

    public function __construct($filename)
    {
        if (!is_string($filename)) {
            throw new \InvalidArgumentException;
        }

        if (!file_exists($filename)) {
            throw new \DomainException("File $filename not found.");
        }

        $this->imageFile = $filename;
    }

    public function getMetadata()
    {
        if (empty($this->metadata)) {
            $reader = \PHPExif\Reader\Reader::factory(\PHPExif\Reader\Reader::TYPE_NATIVE);

            try {
                $exif = $reader->read($this->imageFile);
                $this->metadata = $exif->getData();
            } catch (\RuntimeException $e) {
                // Empty `$this->metadata` if EXIF info cannot be read
            }
        }

        return $this->metadata;
    }
}
