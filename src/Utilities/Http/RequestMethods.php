<?php
/**
 *  Copyright (c) 2017.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Helpers\Utilites\Http;


trait RequestMethods
{

    /**
     * Get the data from this request, sifting out null values where null is not allowed
     *
     * @param       $request
     * @param array $extra_fields
     *
     * @return array
     */
    public function getRequestData($request, array $extra_fields = [])
    {
        $request_keys   = collect($request->rules())->keys();
        $request_keys   = $request_keys->merge($extra_fields);

        $request_keys   = $request_keys->map(function($item, $key) {
            return $item;
        });

        $data           = $request->only($request_keys->toArray());
        $data           = $this->decodeArrays($data);

        return $data;
    }

    private function decodeArrays($data)
    {
        foreach($data as $parent_key => $item) {

            if (is_array($item))
            {

                foreach($data[$parent_key]['*'] as $value_key => $values)
                {

                    foreach($values as $key => $value)
                    {
                        $data[$parent_key][$key][$value_key]   = $value;
                    }
                }

                unset($data[$parent_key]['*']);
            }
        }

        return $data;
    }
}