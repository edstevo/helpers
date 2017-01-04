<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing\Assertions;

use PHPUnit_Framework_Assert as PHPUnit;

trait GeneralAssertions
{

    public function assertInArray($needle, array $haystack)
    {
        return PHPUnit::assertTrue((in_array($needle, $haystack)), $needle . "was not found in the array");
    }
}