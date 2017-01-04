<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing;


use EdStevo\Helpers\Testing\Assertions\DatabaseAssertions;
use EdStevo\Helpers\Testing\Assertions\GeneralAssertions;
use EdStevo\Helpers\Testing\Assertions\ResponseAssertions;

trait Assertions
{
    use DatabaseAssertions, GeneralAssertions, ResponseAssertions;

}