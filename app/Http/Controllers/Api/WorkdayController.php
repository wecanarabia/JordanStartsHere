<?php

namespace App\Http\Controllers\Api;

use App\Models\Workday;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Resources\WorkdayResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;


class WorkdayController extends ApiController
{

    public function __construct()
    {
        $this->resource = WorkdayResource::class;
        $this->model = app(Workday::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

}
