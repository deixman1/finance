<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function get() {
        $incomes = Auth::user()->events->where('outcome_income_type', Income::class);
        foreach ($incomes as $income) {
            $income = $income->outcome_income;
            (empty($incomes['sum']) ? $incomes['sum'] = $income['sum'] : $incomes['sum'] += $income['sum']);
        }
        return $incomes;
    }
    public function create() {

    }
    public function store(Request $request) {
        $request = $request->all();
        $request[0]["name"] = (empty($request[0]["name"]) ? "Приход" : $request[0]["name"]);
        $income = Income::create($request[0]);
        $income->event()->save(Event::find($request[1]));
        /*$income = Income::create([
            'name' => 'Пришла зп',
            'type' => 1,
            'sum'  => 11.2
        ]);*/
    }
    public function edit() {

    }
    public function update() {

    }
    public function destroy() {

    }
}
