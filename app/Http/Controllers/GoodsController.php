<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Good;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    //
    function index(Request $request){
        $type = $request->get('type');
        $date = $request->get('date');
        if(isset($type)&&isset($date)){
            $date = new Carbon( $request->get('date'));

            $data['goods'] = Good::with(array('discount'=>function($query) use ($type,$date){
                if($type=='latest') {
                    $query->where('start', '<=', $date);
                    $query->where('end', '>=', $date)->orWhere('end',null);
                    $query->orderBy('id', 'desc');
                }
                elseif($type=='period') {
                    $query->where('start', '<=', $date);
                    $query->where('end', '>=', $date)->orWhere('end',null);
                    $query->orderByRaw('DATEDIFF(ifnull(`end`,CURDATE()),`start`)');
                }
            }))->get();

        }else {
            $data['goods'] = Good::all();
        }
//        dump($data['goods']);
//
        return view('welcome',$data);
    }
    function single(Request $request, $id){
        $data['good'] = Good::find($id);
        $data['discounts'] = Discount::where('good_id',$id)->get();

        $graph_data = [
            '2018-01-01',
            '2018-02-01',
            '2018-03-01',
            '2018-04-01',
            '2018-05-01',
            '2018-06-01',
            '2018-07-01',
            '2018-08-01',
            '2018-09-01',
            '2018-10-01',
            '2018-11-01',
            '2018-12-01',
        ];

        foreach ($graph_data as $date){
            $good = Good::where('id',$id)->with(array('discount'=>function($query) use ($date){
                    $query->where('start', '<=', $date);
                    $query->where('end', '>=', $date)->orWhere('end',null);
                    $query->orderBy('id', 'desc')->first();
            }))->get();

            $data['latest_graph'][] =  empty($good[0]->discount[0]) ? $good[0]->default_price :  $good[0]->discount[0]->price;

            $good = Good::where('id',$id)->with(array('discount'=>function($query) use ($date,$id){
                $query->where('start', '<=', $date);
                $query->where('end', '>=', $date)->orWhere('end',null);
                $query->orderByRaw('DATEDIFF(ifnull(`end`,CURDATE()),`start`)');
            }))->get();

            $data['lowest_period_graph'][] =   empty($good[0]->discount[0]) ? $good[0]->default_price :  $good[0]->discount[0]->price;

        }


        return view('single',$data);

    }
    function discount_create(Request $request,$id){
        $data = $request->except('_token');

        $data['start'] = new Carbon($data['start']);

        $data['end'] = new Carbon($data['end']);

        $data['good_id'] = $id;


        if(($data['end']>$data['start']||empty($data['end']))&&$data['price']>=0)
            Discount::create($data);
//
        return redirect()->back();
    }
}
