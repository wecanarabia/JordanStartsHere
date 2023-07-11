<?php

namespace App\Http\Controllers\Api;

use App\Models\Help;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\HelpRequest;
use App\Http\Resources\HelpResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class HelpController extends ApiController
{
    public function __construct()
    {
        $this->resource = HelpResource::class;
        $this->model = app(Help::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

}
