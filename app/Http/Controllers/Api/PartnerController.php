<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
use App\Models\City;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PartnerController extends ApiController
{
    public function __construct()
    {
        $this->resource = PartnerResource::class;
        $this->model = app(Partner::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function getSuggestedPartner()
    {
        $model = Partner::where('start_status', 1)->inRandomOrder()->first();

        if ($model) {
            return $this->returnData('data', new $this->resource($model), __('Get successfully'));
        }

        return $this->returnError(__('Sorry! Failed to get!'));
    }


    public function getPartnerByCity($id)
    {

        $city = City::find($id);

        // dd($city->areas?->first()->branches?->first()->partner->id);


        if ($city) {
            return $this->returnData('data', new $this->resource($city->areas?->first()->branches?->first()->partner), __('Get successfully'));
        }

        return $this->returnError(__('Sorry! Failed to get!'));
    }
}
