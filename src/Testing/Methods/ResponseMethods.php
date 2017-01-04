<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing\Methods;


trait ResponseMethods
{

    public function getResponseContent()
    {
        return json_decode($this->response->getContent(), true);
    }
}