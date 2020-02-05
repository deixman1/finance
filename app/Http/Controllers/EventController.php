<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function get() {
        $events = Auth::user()->events;
        foreach ($events as $event) {
            $event = $event->outcome_income;
            if($event instanceof Outcome) {
                $event['sum'] = round($event->items->sum(function ($item){
                    return $item->sum * $item->count;
                }),2);
                $event['items'] = $event->items;
                //(empty($events['sum']) ? $events['sum'] = $event->items->sum('sum') : $events['sum'] += $event->items->sum('sum'));
            }
        }
        return $events;
    }
    public function create() {

    }
    public function store(Request $request) {
        return Event::create([
            'user_id' => Auth::user()->id
        ])->id;
    }
    public function edit() {

    }
    public function update() {

    }
    public function destroy() {

    }
    public function test() {
        return [
            'labels' => ['1', '2', '3'],
            'datasets' => [
                'label' => 'test',
                'data' => [10, 20, 30],
            ]
        ];
    }
}
