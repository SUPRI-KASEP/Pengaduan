<?php

namespace App\Models;

use App\Models\Agencies;
use App\Models\Categories;
use App\Models\Responses;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $fillable = [
        'user_id',
        'categories_id',
        'agencies_id',
        'title',
        'description',
        'photo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agencies::class);
    }

    public function responses()
    {
        return $this->hasMany(Responses::class);
    }
}
