<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing\Methods;


trait RequestMethods
{

    public function xGet($uri, array $data = [], array $headers = [])
    {
        $this->json("GET", $uri, $data, $headers);

        return $this;
    }

    public function xPost($uri, array $data = [], array $headers = [])
    {
        $this->json("POST", $uri, $data, $headers);

        return $this;
    }

    public function xPut($uri, array $data = [], array $headers = [])
    {
        $this->json("PUT", $uri, $data, $headers);

        return $this;
    }

    public function xDelete($uri, array $data = [], array $headers = [])
    {
        $this->json("DELETE", $uri, $data, $headers);

        return $this;
    }
}