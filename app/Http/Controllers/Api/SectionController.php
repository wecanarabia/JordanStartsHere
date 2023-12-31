<?php

namespace App\Http\Controllers\Api;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class SectionController extends ApiController
{
    public function __construct()
    {
        $this->resource = SectionResource::class;
        $this->model = app(Section::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }


}
