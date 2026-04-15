<?php

namespace App\Models;

use App\Models\Reports;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Report_logs extends Model
{
    protected $fillable = [
        'reports_id',
        'changed_by',
        'status',
        'notes'
    ];

    public function reports()
    {
        return $this->belongsTo(Reports::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'changed_by');
    }
}
