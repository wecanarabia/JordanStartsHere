<?php

namespace App\Http\Controllers\Api;

use App\Models\Partner;
use App\Models\WhatsappCounter;
use App\Models\CallCounter;
use App\Models\ViewCounter;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\PartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Resources\PriceResource;
use Illuminate\Support\Facades\DB;

class CounterController extends ApiController
{
    public function __construct()
    {
        $this->resource = PartnerResource::class;
        $this->model = app(Partner::class);
        $this->repositry =  new Repository($this->model);
    }


    public function whatsappCounter(Request $request){


        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $counter=WhatsappCounter::where('partner_id',$request->partner_id)->where('date',$date)->first();
        if($counter)
        {
            $counter->count++;
            $counter->save();
            return $this->returnSuccessMessage('Counter incremented successfully!');
        }

        $call=new WhatsappCounter();
        $call->partner_id=$request->partner_id;
        $call->date=$date;
        $call->month=$month;
        $call->year=$year;
        $call->count=1;
        $call->save();

        return $this->returnSuccessMessage('Counter Created successfully!');
    }


    public function callCounter(Request $request){


        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $counter=CallCounter::where('partner_id',$request->partner_id)->where('date',$date)->first();
        if($counter)
        {
            $counter->count++;
            $counter->save();
            return $this->returnSuccessMessage('Counter incremented successfully!');
        }

        $call=new CallCounter();
        $call->partner_id=$request->partner_id;
        $call->date=$date;
        $call->month=$month;
        $call->year=$year;
        $call->count=1;
        $call->save();

        return $this->returnSuccessMessage('Counter Created successfully!');
    }


    public function ViewCounter(Request $request){


        $date = date('Y-m-d');
        $month = date('m');
        $year = date('Y');

        $counter=ViewCounter::where('partner_id',$request->partner_id)->where('date',$date)->first();
        if($counter)
        {
            $counter->count++;
            $counter->save();
            return $this->returnSuccessMessage('Counter incremented successfully!');
        }

        $call=new ViewCounter();
        $call->partner_id=$request->partner_id;
        $call->date=$date;
        $call->month=$month;
        $call->year=$year;
        $call->count=1;
        $call->save();

        return $this->returnSuccessMessage('Counter Created successfully!');
    }
}
