<?php

namespace App\Http\Controllers\Api;

use App\Models\LandscapeImage;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\LandscapeImageRequest;
use App\Http\Resources\LandscapeImageResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class LandscapeImageController extends ApiController
{
    public function __construct()
    {
        $this->resource = LandscapeImageResource::class;
        $this->model = app(LandscapeImage::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
