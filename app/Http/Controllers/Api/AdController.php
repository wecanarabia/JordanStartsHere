<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AdviceRequest;
use App\Http\Resources\AdResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class AdController extends ApiController
{

    public function __construct()
    {
        $this->resource = AdResource::class;
        $this->model = app(Ad::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

}
