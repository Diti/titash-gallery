<?php

use TitashGallery\Image;

class imageTest extends PHPUnit_Framework_TestCase
{
    private $blankJPEG;

    protected function setUp()
    {
        $this->blankJPEG = new Image(__DIR__ . '/blank.jpg');
    }

    /**
     * @expectedException   DomainException
     */
    public function testFileNotFound()
    {
        $img = new Image('notfound');
    }

    /**
     * @expectedException   InvalidArgumentException
     */
    public function testNotFilename()
    {
        $img = new Image(42);
    }

    /**
     * @expectedException   DomainException
     * @expectedExceptionMessage “Invalid” is not a value defined in \PHPExif\Reader\Reader
     */
    public function testInvalidMetadataReader()
    {
        $this->blankJPEG->setMetadataReader('Invalid');
    }

    /**
    * @expectedException    LogicException
    */
    public function testMissingMetadataReader()
    {
        $this->blankJPEG->getMetadataReader();
    }

    public function testMetadataJPEG()
    {
        $data = $this->blankJPEG->getMetadata();

        $this->assertEquals('Wikimedia Commons', $data['source']);
    }

    public function testMetadataPNG()
    {
        $img = new Image(__DIR__ . '/ffffff7f.png');

        try {
            $data = $img->getMetadata();
        } catch (\UnderflowException $e) {
            $this->markTestIncomplete('Reading of PNG metadata not yet implemented?');
        }

        $this->assertEquals('Wikimedia Commons', $data['source']);
    }

    public function testMetadataTXT()
    {
        $img = new Image(__DIR__ . '/text-plain.txt');
        if (is_executable('/usr/bin/exiftool') || is_executable('/usr/local/bin/exiftool')) {
            // ExifTool can read very basic metadata even from plaintext files
        } else {
            $this->setExpectedException(\UnderflowException::class);
        }
    }
}
