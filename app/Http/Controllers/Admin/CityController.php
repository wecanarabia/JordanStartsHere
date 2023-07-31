<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CityRequest;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = City::latest()->get();
        return view('admin.cities.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $request['title_one']=['en'=>$request->title_one_en,'ar'=>$request->title_one_ar,'fr'=>$request->title_one_fr,'es'=>$request->title_one_es,'ko'=>$request->title_one_ko];
        $request['title_two']=['en'=>$request->title_two_en,'ar'=>$request->title_two_ar,'fr'=>$request->title_two_fr,'es'=>$request->title_two_es,'ko'=>$request->title_two_ko];
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ko'=>$request->name_ko];
        $request['area']=['en'=>$request->area_name_en,'ar'=>$request->area_name_ar,'fr'=>$request->area_name_fr,'es'=>$request->area_name_es,'ko'=>$request->area_name_ko];
        $city = City::create($request->except([
            'title_one_en',
            'title_one_ar',
            'title_one_fr',
            'title_one_es',
            'title_one_ko',
            'title_two_en',
            'title_two_ar',
            'title_two_fr',
            'title_two_es',
            'title_two_ko',
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ko',
            'area_name_en',
            'area_name_ar',
            'area_name_fr',
            'area_name_es',
            'area_name_ko',
            'area'
        ]));

        $request['order']=Area::max('order') + 1;
        Area::create([
            'order'=>$request['order'],
            'city_id'=>$city->id,
            'name'=>$request['area']
        ]);
        return redirect()->route('admin.cities.index')
                        ->with('success','City has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.show',compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
        $city = City::findOrFail($id);
        if ($request->has('image')&&$city->image  && File::exists($city->image)) {
            unlink($city->image);
        }
        $request['title_one']=['en'=>$request->title_one_en,'ar'=>$request->title_one_ar,'fr'=>$request->title_one_fr,'es'=>$request->title_one_es,'ko'=>$request->title_one_ko];
        $request['title_two']=['en'=>$request->title_two_en,'ar'=>$request->title_two_ar,'fr'=>$request->title_two_fr,'es'=>$request->title_two_es,'ko'=>$request->title_two_ko];
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ko'=>$request->name_ko];

        $city->update($request->except([
            'title_one_en',
            'title_one_ar',
            'title_one_fr',
            'title_one_es',
            'title_one_ko',
            'title_two_en',
            'title_two_ar',
            'title_two_fr',
            'title_two_es',
            'title_two_ko',
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ko',
        ]));


        return redirect()->route('admin.cities.index')
                        ->with('success','City has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        City::findOrFail($request->id)->delete();
        return redirect()->route('admin.cities.index')->with('success','City has been removed successfully');
    }
}
