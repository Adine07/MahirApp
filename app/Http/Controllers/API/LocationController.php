<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class LocationController extends Controller
{
    public function provinces(){
        return Province::all();
    }

    public function cities($provinces_id){
        return City::where('province_id', $provinces_id )->get();
    }

    public function districts($cities_id){
        return District::where('city_id', $cities_id )->get();
    }

    public function villages($districts_id){
        return Village::where('district_id', $districts_id )->get();
    }
}
