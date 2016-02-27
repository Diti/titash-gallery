<?php

namespace TitashGallery;

class Image
{
    // Path to the file
    public $imageFile;

    // The image’s metadata
    private $metadata = [];

    // The `\PHPExif\Reader\Reader` type used for metadata decoding
    private $metadataReader;

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
            if (is_executable('/usr/bin/exiftool') || is_executable('/usr/local/bin/exiftool')) {
                $this->setMetadataReader(\PHPExif\Reader\Reader::TYPE_EXIFTOOL);
            } else {
                $this->setMetadataReader(\PHPExif\Reader\Reader::TYPE_NATIVE);
            }

            try {
                $exif = $this->metadataReader->read($this->imageFile);
                $this->metadata = $exif->getData();
            } catch (\RuntimeException $e) {
                throw new \UnderflowException('No metadata read.'); // Force the dev to handle empty metadata cases
            }
        }

        return $this->metadata;
    }

    private function setMetadataReader($reader)
    {
        $refl = new \ReflectionClass(\PHPExif\Reader\Reader::class);
        if (!in_array($reader, $refl->getConstants())) {
            throw new \DomainException(sprintf('“%s” is not a value defined in \PHPExif\Reader\Reader.', $reader));
        }

        $this->metadataReader = \PHPExif\Reader\Reader::factory($reader);
    }

    private function getMetadataReader()
    {
        if (empty($this->metadataReader)) {
            throw new \LogicException('No metadata reader has been set with “setMetadataReader()”.');
        }

        return $this->metadataReader;
    }
}
