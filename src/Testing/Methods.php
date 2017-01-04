<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing;


use EdStevo\Helpers\Testing\Methods\DatabaseMethods;
use EdStevo\Helpers\Testing\Methods\RequestMethods;
use EdStevo\Helpers\Testing\Methods\ResponseMethods;

trait Methods
{
    use DatabaseMethods, RequestMethods, ResponseMethods;

}