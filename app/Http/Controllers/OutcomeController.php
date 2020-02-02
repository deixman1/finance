<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Outcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OutcomeController extends Controller
{
    public function get() {
        $outcomes = Auth::user()->events->where('outcome_income_type', Outcome::class);
        foreach ($outcomes as $outcome) {
            $outcome = $outcome->outcome_income;
            $outcome['sum'] = round($outcome->items->sum(function ($item){
                return $item->sum * $item->count;
            }), 2);
            $outcome['items'] = $outcome->items;
            (empty($outcomes['sum']) ? $outcomes['sum'] = $outcome['sum'] : $outcomes['sum'] += $outcome['sum']);
        }
        return $outcomes;
    }
    public function create() {

    }
    public function store(Request $request) {
        $request = $request->all();
        $income = Outcome::create([
            'name' => (empty($request[0]["name"]) ? "Расход" : $request[0]["name"])
        ]);
        $income->event()->save(Event::find($request[1]));
        return $income->id;
    }
    public function edit() {

    }
    public function update() {

    }
    public function destroy() {

    }
}
