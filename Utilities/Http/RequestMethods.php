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
    public function getRequestData($request, array $extra_fields = []) : array
    {
        $rules          = $request->rules();
        $request_keys   = collect($rules)->keys()->merge($extra_fields)->filter(function($item) {
            return (!str_contains($item, ".*"));
        })->toArray();

        $data           = $request->only($request_keys);

        foreach($data as $key => $value)
        {
            if (!str_contains('nullable', $rules[$key]) && is_null($value))
            {
                unset($data[$key]);
            }
        }

        return $data;
    }
}