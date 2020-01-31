<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Outcome;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function get() {

    }
    public function create() {

    }
    public function store(Request $request) {
        $request = $request->all();
        //dd($request);
        $items = [];
        foreach ($request[0] as $item)
            $items[] = Item::create($item);
        $outcome = Outcome::find($request[1]);
        $outcome->items()->saveMany($items);
    }
    public function edit() {

    }
    public function update() {

    }
    public function destroy() {

    }
}
