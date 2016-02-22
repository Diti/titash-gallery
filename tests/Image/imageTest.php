<?php

use TitashGallery\Image;

class imageTest extends PHPUnit_Framework_TestCase
{

    /**
    * @expectedException     Exception
    * @expectedExceptionCode 404
    */
    public function testFileNotFound()
    {
        $img = new Image('notfound');
    }

    /**
    * @expectedException     Exception
    * @expectedExceptionCode 415
    */
    public function testFiletypeNotSupported()
    {
        $img = new Image(__DIR__ . '/text-plain.txt');
    }
}
