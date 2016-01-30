<?php

use TitashGallery\Work\Work;
use TitashGallery\Work\Arc;

class workTest extends PHPUnit_Framework_TestCase
{
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
    public function testFields($fields)
    {
        $this->assertClassHasAttribute($fields, Work::class);
    }

    public function testFieldArcIsArc()
    {
        $work = new Work();
        $this->assertInstanceOf(Arc::class, $work->arc);
    }

    public function testFieldTitle()
    {
        $emptyTitle = new Work();
        $this->assertNull($emptyTitle->title);

        $singleTitleWork = new Work();
        $singleTitleWork->title = 'English title';
        $this->assertInternalType('string', $singleTitleWork->title);

        $mixedTitleWork = new Work();
        $mixedTitleWork->title = array(
            'en' => 'English title',
            'fr' => 'Titre français',
        );
        $this->assertInternalType('array', $mixedTitleWork->title);
    }
}
