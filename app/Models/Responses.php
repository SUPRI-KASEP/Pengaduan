<?php

namespace App\Models;

use App\Models\Reports;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class Responses extends Model
{
    protected $fillable = [
        'reports_id',
        'user_id',
        'massage',
        'photo',
    ];

    public function reports()
    {
        return $this->belongsTo(Reports::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
