<?php

namespace TitashGallery;

class Image
{

    // Path to the file
    protected $imageFile;

    // Resource of an loaded image (typically by GD)
    protected $res;

    // The image’s metadata
    private $metadata = [];


    public function __construct($file)
    {
        self::loadFromFile($file);
    }

    public function getMetadata()
    {
        $this->metadata = self::getIPTC($this->imageFile);
        return $this->metadata;
    }

    protected function getIPTC($filename)
    {
        $data = [];

        getimagesize($filename, $info);
        if (isset($info['APP13'])) {
            $parsed = iptcparse($info['APP13']);
        }

        if (empty($parsed))
            throw new \UnderflowException('No IPTC data found.');

        foreach($parsed as $tag => $val) {
            switch ($tag) {
                case '2#005': // IPTC “Object Name”
                    $data['title'] = $val[0];
                    break;
                case '2#120': // IPTC “Caption” | EXIF “ImageDescription”
                    $data['description'] = $val[0];
                    break;
                case '2#110': // IPTC “Credit Line”
                    $data['credit'] = $val[0];
                    break;
                case '2#115': // IPTC “Source”
                    $data['source'] = $val[0];
                    break;
                case '2#065': // Software
                    $software = $val[0];

                    if (isset($parsed['2#070'])) { // If a version tag is present
                        $data['software'] = [$software, $parsed['2#070']];
                    } else {
                        $data['software'] = [$software];
                    }
                    break;
                case '2#055': // EXIF “DateTimeOriginal”
                    $data['date_created'] = $val[0]; // TODO: ISO format
                    break;
                case '2#004': // IPTC “Intellectual Genre”
                    $data['genre'] = $val[0];
                    break;
                case '2#025': // IPTC “Keywords”
                    $data['keywords'] = $val;
                    break;
            }
        }

        return $data;
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

    public function __destruct()
    {
        if (!empty($this->res) && get_resource_type($this->res) == 'gd') {
            imagedestroy($this->res);
        }
    }
}
