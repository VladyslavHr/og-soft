<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name',
        'date',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function country() {
        $this->belongTo(Country::class);
    }


}
