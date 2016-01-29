<?php

namespace TitashGallery;

use TitashGallery\Work\Arc;

/*
 * A “work” may be a drawing, or photo, or video…
 */
class Work
{
    /// The work’s title.
    public $title;

    /// The work’s authors/contributors.
    public $author;

    /// The works’s position within a sequence.
    /// -1 means no sequence (= work is unique).
    public $sequence = -1;

    /// The work’s belonging to a story arc.
    /// The work may or may not belong to an arc, and still have relevant,
    ///   optional information, such as: timeline link or date, and period.
    public $arc;

    /// The work’s creation date.
    public $date;

    /// The work’s category.
    /// i.e.: Illustration, Drawing, Livepic, Badge.
    public $category;

    /// The work’s tags (usually species).
    /// i.e.: [Meerkat, Red panda, Human].
    public $tags;

    /// The work’s rating/audience.
    /// i.e.: Everyone, [Cartoon Violence, Comic Mischief]
    public $rating;

    /// The work’s technique/medium.
    /// i.e.: Traditional, Digital, Mixed.
    public $medium;

    /// Setting/universe to which the work belongs to.
    /// i.e.: Titash, Pucky, Pistash.
    public $universe;

    /// Characters appearing within the work.
    public $characters;

    /// The work’s description.
    public $description;

    /// Pages related to the work.
    public $related;

    /// Shop pages related to the work.
    public $related_shop;

    /// The work’s copyrights.
    public $copyright;


    function __construct()
    {
        $this->arc = new Arc;
    }
}
