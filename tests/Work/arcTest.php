<?php

use TitashGallery\Work\Work;
use TitashGallery\Work\Arc;

class arcTest extends PHPUnit_Framework_TestCase
{
    public function fieldNames()
    {
        return array(
            ['timelineURL'],
            ['period'],
            ['date'],
        );
    }

    /**
     * @dataProvider fieldNames
     */
    public function testFields($fields)
    {
        $this->assertClassHasAttribute($fields, Arc::class);
    }
}
