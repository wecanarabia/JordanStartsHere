<?php

namespace App\Http\Controllers\Api;

use App\Models\Advice;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AdviceRequest;
use App\Http\Resources\AdviceResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class AdviceController extends ApiController
{
    public function __construct()
    {
        $this->resource = AdviceResource::class;
        $this->model = app(Advice::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function getLastAdvice()
    {
        $last = Advice::orderBy('id', 'desc')->first();

        return $this->returnData('data', new $this->resource($last), __('Updated successfully'));
    }
}
