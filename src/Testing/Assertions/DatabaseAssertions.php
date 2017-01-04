<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing\Assertions;

use Illuminate\Support\Facades\DB;
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

    /**
     * Test that a database table is empty
     *
     * @param string $table
     *
     * @return $this
     */
    protected function assertTableEmpty(string $table)
    {
        PHPUnit::assertEquals($this->getTableCount($table), 0, 'The table ' . $table . ' was not empty when it was expected to be.');

        return $this;
    }

    /**
     * Test that a table is not empty
     *
     * @param string $table
     *
     * @return $this
     */
    protected function assertTableNotEmpty(string $table)
    {
        PHPUnit::assertGreaterThan(0, $this->getTableCount($table), 'The table ' . $table . ' was empty when it was expected to be.');

        return $this;
    }

    /**
     * Count rows in a table
     *
     * @param string $table
     *
     * @return mixed
     */
    private function getTableCount(string $table, array $data = [])
    {
        return DB::table($table)->where($data)->count();
    }

    /**
     * Assert that some data is in the database
     *
     * @param       $table
     * @param array $array
     *
     * @return $this
     */
    protected function assertInDatabase($table, array $array = [])
    {
        PHPUnit::assertGreaterThan(0, $this->getTableCount($table), 'Some data was expected to be in the table ' . $table . ' when it wasn\'t.');

        return $this;
    }
}