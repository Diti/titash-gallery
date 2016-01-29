<?php

use TitashGallery\Work;

class WorkTest extends PHPUnit_Framework_TestCase
{
    protected $work;

    public function setUp()
    {
        $this->work = new Work;
    }

    public function testInit()
    {
        $work = get_class($this->work);

        $this->assertClassHasAttribute('title', $work);
        $this->assertClassHasAttribute('author', $work);
        $this->assertClassHasAttribute('sequence', $work);
        $this->assertClassHasAttribute('arc', $work);
        $this->assertClassHasAttribute('date', $work);
        $this->assertClassHasAttribute('category', $work);
        $this->assertClassHasAttribute('tags', $work);
        $this->assertClassHasAttribute('rating', $work);
        $this->assertClassHasAttribute('medium', $work);
        $this->assertClassHasAttribute('universe', $work);
        $this->assertClassHasAttribute('characters', $work);
        $this->assertClassHasAttribute('description', $work);
        $this->assertClassHasAttribute('related', $work);
        $this->assertClassHasAttribute('related_shop', $work);
        $this->assertClassHasAttribute('copyright', $work);
    }
}
