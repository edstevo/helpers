<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Testing\Methods;

use Illuminate\Support\Facades\DB;

trait DatabaseMethods
{

    public function insertToDB(string $table, array $data)
    {
        return DB::table($table)->insertGetId($data);
    }
}