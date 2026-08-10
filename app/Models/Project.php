<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'project_id',
        'project_title',
        'contract_amount',
        'revised_contract_amount',
        'contractor',
        'project_engineer',
        'location',
        'status',
        'slippage',
        'start_date',
        'expiry_date',
        'target_completion',
        'actual_completion',
        'physical_accomplishment',
        'financial_accomplishment',
        'latitude',
        'longitude',
    ];

    public function photos()
    {
        return $this->hasMany(ProjectPhoto::class);
    }

    public function commitments()
    {
        return $this->hasMany(ProjectCommitment::class);
    }

    // IMPORTANT: disable updated_at
    const UPDATED_AT = null;
}