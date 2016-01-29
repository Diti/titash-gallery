<?php

use TitashGallery\Work;

class WorkTest extends PHPUnit_Framework_TestCase
{
    protected $work;

    public function setUp()
    {
        $this->work = new Work;
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
    public function testClassHasField($field)
    {
        $this->assertClassHasAttribute($field, get_class($this->work));
    }
}
