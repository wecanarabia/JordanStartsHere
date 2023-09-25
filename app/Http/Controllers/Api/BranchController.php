<?php

namespace App\Http\Controllers\Api;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\BranchRequest;
use App\Http\Resources\BranchResource;
use App\Http\Resources\BranchDistanceResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class BranchController extends ApiController
{
    public function __construct()
    {
        $this->resource = BranchResource::class;
        $this->model = app(Branch::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        return $miles * 1.609344;
    }




    public function nearest(Request $request) {
        $lat=$request->lat_user;
        $long=$request->long_user;

        $branches = Branch::all();
        return $this->returnData('data', BranchDistanceResource::collection($branches), __('Get partners successfully'));
    }

public function old(Request $request)
{


    $branches = Branch::all();

    $resources = [];

    foreach ($branches as $branch) {
        // if ($branch->partner->status == 1) {
        $distance = $this->distance($request->lat_user, $request->long_user, $branch->lat, $branch->long);

        if ($distance <= 9) { // Check if the distance is within 5 kilometers
            $resource = new BranchDistanceResource($branch, $distance);

            $resources[] = $resource;
        }
    // }
}

    // Sort the resources by their distance from the user's location
    usort($resources, function($a, $b) {
        return $a->distance <=> $b->distance;
    });

    return $this->returnData('data', $resources, __('Get nearby branches successfully'));
}

}
