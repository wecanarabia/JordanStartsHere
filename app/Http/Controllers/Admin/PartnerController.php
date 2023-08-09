<?php

namespace App\Http\Controllers\Admin;


use App\Models\Area;
use App\Models\Branch;
use App\Models\Partner;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\PortraitImage;
use App\Models\LandscapeImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\PartnerRequest;

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
        $areas = Area::all();
        return view('admin.partners.create',compact('subcategories','areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartnerRequest $request)
    {
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,''=>$request->name_ru];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar,'fr'=>$request->description_fr,'es'=>$request->description_es,''=>$request->description_ru];
        $partner=Partner::create($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ru',
            'branch_name_en',
            'branch_name_ar',
            'branch_name_fr',
            'branch_name_es',
            'branch_name_ru',
            'description_en',
            'description_ar',
            'description_fr',
            'description_es',
            'description_ru',
            'subcategories',
            'portraits',
            'landscapes',
            'area_id',
            'lat',
            'long',
            'location',
        ]));
        $partner->subcategories()->attach($request->subcategories);
        foreach($request->portraits as $image) {
            if (PortraitImage::where('partner_id',$partner->id)->count()==0) {
                $order = 1;
            }else{
                $order = PortraitImage::where('partner_id',$partner->id)->max('order')+1;
            }
            PortraitImage::create([
                'image'=>$image,
                'order'=>$order,
                'partner_id'=>$partner->id,
            ]);
        }
        foreach($request->landscapes as $image) {
            if (LandscapeImage::where('partner_id',$partner->id)->count()==0) {
                $order = 1;
            }else{
                $order = LandscapeImage::where('partner_id',$partner->id)->max('order')+1;
            }
            LandscapeImage::create([
                'image'=>$image,
                'order'=>$order,
                'partner_id'=>$partner->id,
            ]);
        }
        $request['branch_name']=['en'=>$request->branch_name_en,'ar'=>$request->branch_name_ar,'fr'=>$request->branch_name_fr,'es'=>$request->branch_name_es,''=>$request->branch_name_ru];
        Branch::create([
            'name'=>$request['branch_name'],
            'area_id'=>$request->area_id,
            'partner_id'=>$partner->id,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'location'=>$request->location,
        ]);
        return redirect()->route('admin.partners.index')
                        ->with('success','Partner has been added successfully');
    }



    public function show(string $id)
    {
        $partner = Partner::with(['subcategories','whatsappCounter','callCounter','viewCounter','portraits'=>function ($q) {
            $q->orderBy('order');
        },'landscapes'=>function ($q) {
            $q->orderBy('order');
        }
        ])->findOrFail($id);
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
        $request['name']=['en'=>$request->name_en,'ar'=>$request->name_ar,'fr'=>$request->name_fr,'es'=>$request->name_es,''=>$request->name_ru];
        $request['description']=['en'=>$request->description_en,'ar'=>$request->description_ar,'fr'=>$request->description_fr,'es'=>$request->description_es,''=>$request->description_ru];
        $partner->update($request->except([
            'name_en',
            'name_ar',
            'name_fr',
            'name_es',
            'name_ru',
            'description_en',
            'description_ar',
            'description_fr',
            'description_es',
            'description_ru',
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
