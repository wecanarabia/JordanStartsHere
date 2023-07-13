<?php

namespace App\Http\Controllers\Api;

use App\Models\PartnerSubcategory;
use App\Models\Partner;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Resources\PartnerSubcategoryResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;


class PartnerSubcategoryController extends ApiController
{
    public function __construct()
    {
        $this->resource = PartnerSubcategoryResource::class;
        $this->model = app(PartnerSubcategory::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){

        $model = PartnerSubcategory::where('partner_id',$request->partner_id)->where('subcategory_id',$request->subcategory_id)->first();
        if($model){
            return $this->returnError(__('Sorry! It is already exist !'));
        }
        return $this->store( $request->all() );
    }








}
