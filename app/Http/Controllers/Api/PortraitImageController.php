<?php

namespace App\Http\Controllers\Api;

use App\Models\PortraitImage;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\PortraitImageRequest;
use App\Http\Resources\PortraitImageResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class PortraitImageController extends ApiController
{
    public function __construct()
    {
        $this->resource = PortraitImageResource::class;
        $this->model = app(PortraitImage::class);
        $this->repositry =  new Repository($this->model);
    }

    public function pImages()
    {

        $data = PortraitImage::orderBy('order','asc')->get();

        return $this->returnData( 'data' , $this->resource::collection( $data ), __('Succesfully'));


    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
