<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing\Assertions;

use PHPUnit_Framework_Assert as PHPUnit;

trait ResponseAssertions
{

    public function assertResponseHasKeys($keys)
    {
        $response = $this->getResponseContent();

        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $response);
        }
    }

    public function assertInsufficientPermissions()
    {
        $this->assertResponseStatus(403);
        $this->assertResponseEquals(['error' => config('errors.auth.insufficient_permissions')]);
    }

    public function assertResponseEquals($assertion, bool $firstLevelOnly = true)
    {
        if (is_object($assertion)) {
            $assertion = json_decode(json_encode($assertion), true);
        }

        if ($firstLevelOnly) {
            foreach ($assertion as $key => $value) {
                if (is_array($value))
                    unset($assertion[$key]);
            }
        }

        $response = $this->getResponseContent();

        ksort($assertion);
        ksort($response);

        $json_assertion = json_encode($assertion);
        $json_response = json_encode($response);

        return PHPUnit::assertTrue($response == $assertion, "Actual reponse (first line) does not match expected response (second line):
{$json_response}
{$json_assertion}");
    }
}