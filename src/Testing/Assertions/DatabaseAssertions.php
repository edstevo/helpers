<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing\Assertions;

use EdStevo\Generators\Dao\DaoModel;
use Illuminate\Database\Eloquent\Model;
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
        PHPUnit::assertEquals($expectedCount, $this->getTableCount($table, $data), sprintf(
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
    protected function assertInDatabase($data, string $table = null)
    {
        if ($data instanceof Model)
        {
            $table      = $data->getTable();
            $data       = $data->toArray();
        }

        PHPUnit::assertGreaterThan(0, $this->getTableCount($table, $data), 'Some data was expected to be in the table ' . $table . ' when it wasn\'t.');

        return $this;
    }

    /**
     * Assert that some data is in the database
     *
     * @param       $table
     * @param array $array
     *
     * @return $this
     */
    protected function assertNotInDatabase($data, string $table = null)
    {
        if ($data instanceof DaoModel)
        {
            $table      = $data->getTable();
            $data       = $this->extractModelData($data);
        }

        PHPUnit::assertEquals(0, $this->getTableCount($table, $data), 'Some data was expected to not be in the table ' . $table . ' when it was.');

        return $this;
    }

    private function extractModelData(DaoModel $model) : array
    {
        $data       = $model->toArray();
        $appends    = $model->getAppends();

        foreach($appends as $field)
        {
            unset($data[$field]);
        }

        return $data;
    }
}