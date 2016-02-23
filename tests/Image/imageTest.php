<?php

use TitashGallery\Image;

class imageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException     DomainException
     */
    public function testFileNotFound()
    {
        $img = new Image('notfound');
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testNotFilename()
    {
        $img = new Image(42);
    }

    public function testFiletypeNotSupported()
    {
        $img = new Image(__DIR__.'/text-plain.txt');
        $data = $img->getMetadata();

        $this->assertEmpty($data);
    }

    public function testMetadataJPEG()
    {
        $img = new Image(__DIR__.'/blank.jpg');
        $data = $img->getMetadata();

        $this->assertEquals('Wikimedia Commons', $data['source']);
    }

    public function testMetadataPNG()
    {
        $img = new Image(__DIR__.'/ffffff7f.png');
        $data = $img->getMetadata();

        $this->assertEquals('Wikimedia Commons', $data['source']);
    }
}
