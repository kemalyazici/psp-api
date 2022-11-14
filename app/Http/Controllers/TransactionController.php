<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('apikey:api');
    }
    public function report(Request $request){
        $currencies = auth()->user()->transactions()->whereBetween('date',[$request->fromDate,$request->toDate])->groupBy('currency')->get();
        $response = array();
        foreach ($currencies as $c){
            $total = auth()->user()->transactions()->whereBetween('date',[$request->fromDate,$request->toDate])->where('currency',$c->currency)->sum('amount');
            $count = auth()->user()->transactions()->whereBetween('date',[$request->fromDate,$request->toDate])->where('currency',$c->currency)->count();
            $arr = [
                'count' => $count,
                'total' => $total,
                'currency' => $c->currency
            ];
            $response[] = $arr;
        }


        return response(['status'=>'APPROVED', 'response'=>$response],200);
    }

    public function list(Request $request){

        $transactions = auth()->user()->transactions();

        $list = $transactions->whereBetween('date',[$request->fromDate,$request->toDate]);
        foreach ($request->all() as $k =>$a){
            if($k!="fromDate" && $k!="apiKey" && $k!="toDate" && $k!="page" && $a != ""){
                $transactions->where($k,$a);
            }

        }
        return response($list->paginate(50),200);
    }

    public function transaction(Request $request){
        $transaction = Transaction::where('transactionId',$request->transactionId)->first();
        $merchant = $transaction->user;
        $client = $transaction->customer;
        $myDateTime = DateTime::createFromFormat('Y-m-d', $transaction->date);
        $transaction->date = $myDateTime->format('j F Y');
        unset($transaction->user);
        unset($transaction->customer);

        return response([
            'merchant' => $merchant,
            "client" => $client,
            "transaction" => $transaction
        ],200);

    }

    public function client(Request $request){
        $transaction = Transaction::where('transactionId',$request->transactionId)->first();
        $client = $transaction->customer;
        unset($transaction->user);
        unset($transaction->customer);

        return response([
            "clientInfo" => $client,
        ],200);

    }
}
