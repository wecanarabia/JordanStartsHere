<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class BlogController extends ApiController
{
    public function __construct()
    {
        $this->resource = BlogResource::class;
        $this->model = app(Blog::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function view($id)
    {
        $model = $this->repositry->getByID($id);

        $views = (int)$model->number_of_views + 1;

        $model->update([
            'number_of_views' => $views
        ]);

        if ($model) {
            return $this->returnData('data', new $this->resource($model), __('Get  succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));
    }



    public function recentBlogs(){


        $data=Blog::orderBy('id', 'DESC')->take(5)->get();
        return $this->returnData('data',  BlogResource::collection( $data ), __('Get  succesfully'));

       }

       public function getBlogs($section_id){

        $section = Section::find( $section_id );
        if( $section->blogs() ){

            return $this->returnData('data',  BlogResource::collection( $section->blogs ), __('Get  succesfully'));
        }

        return $this->returnError(__('Sorry! Failed to get !'));

    }

    public function getRandomBlogs($section_id)
{
    $section = Section::find($section_id);
    if ($section && $section->blogs()->count() > 0) {
        $data = $section->blogs()->inRandomOrder()->take(5)->get();
        return $data;
        return $this->returnData('data', BlogResource::collection($data), __('Get successfully'));
    }
    return $this->returnError(__('Sorry! Failed to get!'));
}

    public function mostWatchedBlogs()
    {
        $data = Blog::orderBy('number_of_views', 'desc')->take(5)->get();
        return $this->returnData('data', BlogResource::collection($data), __('Get successfully'));
    }

}
