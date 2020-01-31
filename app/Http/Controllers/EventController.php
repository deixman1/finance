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
                //(empty($events['sum']) ? $events['sum'] = $event->items->sum('sum') : $events['sum'] += $event->items->sum('sum'));
                $event['sum'] = $event->items->sum('sum');
                $event['items'] = $event->items;
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
        /*$event = new Event;
        $event->outcome_income()->associate()->save();*/
        /*return Event::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'user_id' => Auth::user()->id
        ])->id;*/
        /*$event = Event::find(1);
        $income = Income::find(1);
        $event->outcome_income()->associate($income)->save();*/

    }
    public function edit() {

    }
    public function update() {

    }
    public function destroy() {

    }
}
