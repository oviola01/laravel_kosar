<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function index(){
        return response()->json(Basket::all());
    }

    public function show($user_id, $item_id){
        $basket = Basket::where('user_id', $user_id)
        ->where('item_id',"=", $item_id)
        ->get();
        return $basket[0];
    }

    public function store(Request $request){
        $item = new Basket();
        $item->user_id = $request->user_id;
        $item->item_id = $request->item_id;
                
        $item->save();
    }

    public function update(Request $request, $user_id, $item_id){
        $item = $this->show($user_id, $item_id);
        $item->user_id = $request->user_id;
        $item->item_id = $request->item_id;

        $item->save();
    }

    public function destroy($user_id, $item_id){
        $this->show($user_id, $item_id)->delete();
    }

    public function itemsBeginB(){
        $user = Auth::user();
        return DB::table('baskets as bask')
            ->join('products as p', 'bask.item_id', '=', 'prod.item_id')
            ->join('producttypes as tp', 'prod.type_id', '=', 'tp.type_id')
            ->where(['user_id', $user->id], ['tp.name', 'like', 'b%'])
            ->get();
    }

    public function addItem($item_id){
        $user = Auth::user();
        $item = new Basket();
        $item->user_id=$user->id;
        $item->item_id=$item_id;
        $item->save();
    }
        

}
