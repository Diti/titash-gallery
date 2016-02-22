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

    /**
    * @expectedException     DomainException
    */
    public function testFiletypeNotSupported()
    {
        $img = new Image(__DIR__ . '/text-plain.txt');
    }

    public function testMetadataJPG()
    {
        $img = new Image(__DIR__ . '/blank.jpg');
        $data = $img->getMetadata();

        $this->assertEquals('Wikimedia Commons', $data['source']);
    }
}
