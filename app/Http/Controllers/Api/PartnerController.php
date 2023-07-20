<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
use App\Models\City;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;


class PartnerController extends ApiController
{
    public function __construct()
    {
        $this->resource = PartnerResource::class;
        $this->model = app(Partner::class);
        $this->repositry =  new Repository($this->model);
    }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }

    public function getSuggestedPartner()
    {
        $model = Partner::where('start_status', 1)->inRandomOrder()->first();

        if ($model) {
            return $this->returnData('data', new $this->resource($model), __('Get successfully'));
        }

        return $this->returnError(__('Sorry! Failed to get!'));
    }


    // public function getPartnerByCity($id)
    // {

    //     $city = City::find($id);

    //     // dd($city->areas?->first()->branches?->first()->partner->id);


    //     if ($city) {
    //         return $this->returnData('data', new $this->resource($city->areas?->first()->branches?->first()->partner), __('Get successfully'));
    //     }

    //     return $this->returnError(__('Sorry! Failed to get!'));
    // }


//     public function getPartnerByCity($id)
// {
//     $city = City::find($id);

//     if (!$city) {
//         return $this->returnError(__('Sorry! Failed to get!'));
//     }

//     $partners = collect();

//     foreach ($city->areas as $area) {
//         foreach ($area->branches as $branch) {
//             $partners->push($branch->partner);
//         }
//     }

//     if ($partners->isEmpty()) {
//         return $this->returnError(__('No partners found for the specified city!'));
//     }

//     return $this->returnData('data', $this->resource::collection($partners), __('Get successfully'));
// }

public function getPartnerByCity($id)
{
    $city = City::find($id);

    if (!$city) {
        return $this->returnError(__('Sorry! Failed to get!'));
    }

    $partners = Partner::whereIn('id', function ($query) use ($city) {
        $query->select('partner_id')
            ->from('branches')
            ->whereIn('area_id', function ($query) use ($city) {
                $query->select('id')
                    ->from('areas')
                    ->where('city_id', $city->id);
            });
    })->get();

    if ($partners->isEmpty()) {
        return $this->returnError(__('No partners found for the specified city!'));
    }

    return $this->returnData('data', $this->resource::collection($partners), __('Get successfully'));
}

public function getPartnersByCategory($id)
    {
        $partners = Partner::whereHas('subcategories', function ($query) use ($id) {
        $query->where('category_id', $id);
    })->get();
        return $this->returnData('data', $this->resource::collection($partners), __('Get successfully'));
    }

   public function getPartnersBySubcategoryId($id)
{
$partners = Partner::whereHas('subcategories', function ($query) use ($id) {
$query->where('subcategory_id', $id);
})->get();
return $this->returnData('data', $this->resource::collection($partners), __('Get successfully'));
}


     public function getPartnersByName(Request $request)
     {



            $partners = Partner::where( "name->".$request->header('X-localization'), 'like', '%' . $request->name . '%' )->get();
            return $this->returnData('data', $this->resource::collection($partners), __('Get successfully'));

     }


     public function getPartnersByNameAndCategory(Request $request,$id, $name)
{
    $partners = Partner::whereHas('subcategories', function ($query) use ($id) {
        $query->where('category_id', $id);
    })->where("name->".$request->header('X-localization'), 'like', '%'.$name.'%')->get();

    return $this->returnData('data', $this->resource::collection($partners), __('Get successfully'));
}



// public function getPartners(Request $request)
// {


// $cityMatrix = $request->cities ?? [];
// $areaMatrix = $request->areas ?? [];
// $startPrice = $request->start_price ?? null;
// $minAvgPoints = $request->avg_points ?? null;

// $partners = Partner::query();

// if (!empty($cityMatrix)) {
//     $partners->whereHas('branches', function ($query) use ($cityMatrix) {
//         $query->whereIn('area_id', function ($query) use ($cityMatrix) {
//             $query->select('id')
//                   ->from('areas')
//                   ->whereIn('city_id', $cityMatrix);
//         });
//     });
// }

// if (!empty($areaMatrix)) {
//     $partners->whereHas('branches', function ($query) use ($areaMatrix) {
//         $query->whereIn('area_id', $areaMatrix);
//     });
// }

// if (!is_null($startPrice)) {

//         $partners->where(function ($query) use ($startPrice) {
//             $query->where('start_price', '<=', $startPrice);
//         });
//     }


// if (!is_null($minAvgPoints)) {
//     $partners->withAvg('reviews', 'points')->havingRaw('AVG(reviews.points) = ?', [$minAvgPoints]);
// }

// $partners = $partners->distinct()->get();

// return $this->returnData('data', $this->resource::collection($partners), __('Get successfully'));
// }



public function getPartners(Request $request)
{
    $resources = [];

    if (isset($request->cities)) {
        $cityIds = $request->cities;
        $partners = Partner::whereHas('branches.area.city', function ($query) use ($cityIds) {
            $query->whereIn('id', $cityIds);
        })->get();

        foreach ($partners as $partner) {
            $resource = new PartnerResource($partner);
            $resources[$partner->id] = $resource;
        }
    }

    if (isset($request->areas)) {
        $areaIds = $request->areas;
        $partners = Partner::whereHas('branches.area', function ($query) use ($areaIds) {
            $query->whereIn('id', $areaIds);
        })->get();

        foreach ($partners as $partner) {
            if (!isset($resources[$partner->id])) {
                $resource = new PartnerResource($partner);
                $resources[$partner->id] = $resource;
            }
        }
    }

    // if (!is_null($request->start_price)) {

    //    $partners=Partner::where('start_price', '==', $request->start_price)
    //    ->orWhere('start_price', '<', $request->start_price)
    //    ->get();

    //         foreach ($partners as $partner) {
    //             $resource = new PartnerResource($partner);
    //             $resources[$partner->id] = $resource;
    //         }

    // }

    if (!is_null($request->start_price)) {
        $partners = Partner::where(function ($query) use ($request) {
            $query->where('start_price', '<=', $request->start_price)
                  ->orWhereNull('start_price');
        })->get();

        foreach ($partners as $partner) {
            $resource = new PartnerResource($partner);
            $resources[$partner->id] = $resource;
        }
    }

//server
    // if (!is_null($request->avg)) {
    //     $partners = Partner::whereHas('reviews', function($query) use ($request) {
    //         $query->select('partner_id', DB::raw('AVG(points) as avg_points'))
    //               ->havingRaw('AVG(points) = ?', [$request->avg])
    //               ->groupBy('id', 'name', 'description', 'logo', 'video_url', 'file', 'price_rate', 'start_price', 'phone','whatsapp','start_status','created_at', 'updated_at'
    //             );
    //         })->get();

    //     foreach ($partners as $partner) {
    //         $resource = new PartnerResource($partner);
    //         $resources[$partner->id] = $resource;
    //     }
    // }


    if (!is_null($request->avg)) {
        $partners = Partner::select('partners.*')
            ->join(DB::raw('(SELECT partner_id, AVG(points) as avg_points FROM reviews GROUP BY partner_id) as review_avg'), 'partners.id', '=', 'review_avg.partner_id')
            ->where('review_avg.avg_points', '=', $request->avg)
            ->get();

        foreach ($partners as $partner) {
            $resource = new PartnerResource($partner);
            $resources[$partner->id] = $resource;
        }
    }


    //local
    // if (!is_null($request->avg)) {
    //     $partners = Partner::whereHas('reviews', function($query) use ($request) {
    //         $query->havingRaw('AVG(points) = ?', [$request->avg]);
    //     })->get();

    //     foreach ($partners as $partner) {
    //         $resource = new PartnerResource($partner);
    //         $resources[$partner->id] = $resource;
    //     }
    // }

    $resources = array_values($resources);

    return $this->returnData('data', $resources, __('Get partners successfully'));
}




public function getMinAndMaxOfPrice(Request $request)
{
    $partners = Partner::all();

    $min = $partners->min('start_price');
    $max = $partners->max('start_price');

    return $this->returnData('data', ['min' => $min, 'max' => $max], 'Get min and max of partners successfully');
}



}
