<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $table = 'outcome';
    protected $guarded = [];
    protected $fillable = [
        'name', 'sum', 'item_id'
    ];

    public function event() {
        return $this->morphMany(Event::class, 'outcome_income');
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
}
