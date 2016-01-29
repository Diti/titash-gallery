<?php

use TitashGallery\Work;
use TitashGallery\Work\Arc;

class workTest extends PHPUnit_Framework_TestCase
{
    protected $work;

    public function setUp()
    {
        $this->work = new Work();
    }

    public function fieldNames()
    {
        return array(
            ['title'],
            ['author'],
            ['sequence'],
            ['arc'],
            ['date'],
            ['category'],
            ['tags'],
            ['rating'],
            ['medium'],
            ['universe'],
            ['characters'],
            ['description'],
            ['related'],
            ['related_shop'],
            ['copyright'],
        );
    }

    /**
     * @dataProvider fieldNames
     */
    public function testFieldsName($fields)
    {
        $this->assertClassHasAttribute($fields, Work::class);
    }

    public function testFieldArcIsArc()
    {
        $this->assertInstanceOf(Arc::class, $this->work->arc);
    }
}
