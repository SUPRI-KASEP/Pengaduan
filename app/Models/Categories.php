<?php

namespace App\Models;

use App\Models\Reports;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function reports()
    {
        return $this->hasMany(Reports::class);
    }
}
