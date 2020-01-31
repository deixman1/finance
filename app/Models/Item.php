<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    protected $guarded = [];
    protected $fillable = [
        'name', 'sum'
    ];
    public $timestamps = true;

    public function outcome()
    {
        return $this->belongsTo(Outcome::class);
    }
}
