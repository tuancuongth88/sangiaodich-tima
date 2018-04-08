<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //

    public function getDistrictByCity(Request $request)
    {
        if ($request->ajax()) {
            $city = $request->get('city_id');
            $trees = getDistrictList($city);
            return response()->json($trees);
        }
        return response()->json('Something wrong!', 400);
    }

    public function getWardByDistrict(Request $request)
    {
        if ($request->ajax()) {
            $district = $request->get('district_id');
            $trees = getWardList($district);
            return response()->json($trees);
        }
        return response()->json('Something wrong!', 400);
    }

}