<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'income';
    protected $guarded = [];
    protected $fillable = [
        'name', 'type', 'sum',
    ];

    public function event() {
        return $this->morphMany(Event::class, 'outcome_income');
    }

}
