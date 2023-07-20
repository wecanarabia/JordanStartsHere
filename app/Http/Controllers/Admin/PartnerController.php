<?php

namespace App\Http\Controllers\Admin;


use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use Illuminate\Support\Facades\File;
use App\Models\Partner;

class PartnerController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Partner::latest()->get();
        return view('admin.partners.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategories = Subcategory::all();
        return view('admin.partners.create',compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartnerRequest $request)
    {
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ko'=>$request->name_ko];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar,'fr'=>$request->description_fr,'es'=>$request->description_es,'ko'=>$request->description_ko];
        $partner=Partner::create($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ko',
            'description_en',
            'description_ar',
            'description_fr',
            'description_es',
            'description_ko',
            'subcategories',
        ]));
        $partner->subcategories()->attach($request->subcategories);

        return redirect()->route('admin.partners.index')
                        ->with('success','Partner has been added successfully');
    }



    public function show(string $id)
    {
        $partner = Partner::with('subcategories')->findOrFail($id);
        return view('admin.partners.show',compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partner = Partner::with('subcategories')->findOrFail($id);
        $subcategories = Subcategory::all();
        return view('admin.partners.edit',compact('partner','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartnerRequest $request, string $id)
    {
        $partner = Partner::findOrFail($id);

        if ($request->has('logo')&&$partner->logo  && File::exists($partner->logo)) {
            unlink($partner->logo);
        }
        if ($request->has('file')&&$partner->file  && File::exists($partner->file)) {
            unlink($partner->file);
        }
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,'ko'=>$request->name_ko];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar,'fr'=>$request->description_fr,'es'=>$request->description_es,'ko'=>$request->description_ko];
        $partner->update($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ko',
            'description_en',
            'description_ar',
            'description_fr',
            'description_es',
            'description_ko',
            'subcategories',
        ]));
        $partner->subcategories()->sync($request->subcategories);

        return redirect()->route('admin.partners.index')
                        ->with('success','Partner has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Partner::findOrFail($request->id)->delete();
        return redirect()->route('admin.partners.index')->with('success','Partner has been removed successfully');
    }

    public function openFile($id)
    {
        $partner = Partner::findOrFail($id);
        return response()->file($partner->file);
    }
}
