<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCommitment extends Model
{
    protected $fillable = [
        'project_id',
        'commitment_month',
        'actual',
        'planned',
        'slippage',
        'advance_payment',
        'progress_interim',
    ];
}