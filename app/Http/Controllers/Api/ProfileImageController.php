<?php

namespace App\Http\Controllers\Api;

use App\Models\ProfileImage;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Resources\ProfileImageResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ProfileImageController extends ApiController
{
    public function __construct()
    {
        $this->resource = ProfileImageResource::class;
        $this->model = app(ProfileImage::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
