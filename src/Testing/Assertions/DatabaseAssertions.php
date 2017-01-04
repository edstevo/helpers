<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing\Assertions;

use PHPUnit_Framework_Assert as PHPUnit;

trait DatabaseAssertions
{

    /**
     * Assert that a given where condition exists in the database.
     *
     * @param  string  $table
     * @param  array  $data
     * @param  int  $count
     *
     * @return $this
     */
    protected function countInDatabase(string $table, array $data, int $expectedCount)
    {
        $database       = app()->make('db');
        $connection     = $database->getDefaultConnection();

        $actualCount    = $database->connection($connection)->table($table)->where($data)->count();

        PHPUnit::assertEquals($expectedCount, $actualCount, sprintf(
            'Unable to find the number of rows specified in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }
}