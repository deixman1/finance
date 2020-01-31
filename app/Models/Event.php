<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $guarded = [];
    protected $fillable = [
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function outcome_income()
    {
        return $this->morphTo();
    }

    /*public function incomes(){
        return $this->hasMany('App\Models\Income');
    }

    public function outcomes(){
        return $this->hasMany('App\Models\Outcome');
    }*/
}
