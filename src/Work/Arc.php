<?php

namespace TitashGallery\Work;

class Arc
{
    /// By default, the work is NOT an Arc; it is independent.
    public $isIndep = true;

    /// Link to the corresponding Titash timeline.
    public $timelineURL;

    /// Period identifier in which the Arc is set.
    public $period;

    /// Date during which the Arc takes place.
    public $date;

    /*
     * The following attributes are only applicable if the Work is indeed an Arc.
     */

    private $name;


    public function __construct($isArc = false)
    {
        $this->isIndep = !$isArc;
    }

    public function getName()
    {
        return ($this->isIndep ? null : $this->name);
    }

    public function setName($arcName)
    {
        $this->name = $this->isIndep ? null : $arcName;
    }
}
