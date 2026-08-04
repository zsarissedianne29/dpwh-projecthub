<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'engineer_name',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
    |--------------------------------------------------------------------------
    | Role Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is engineer.
     */
    public function isEngineer(): bool
    {
        return in_array($this->role, ['engineer', 'project_engineer']);
    }

    /**
     * Check if user is viewer.
     */
    public function isViewer(): bool
    {
        return $this->role === 'viewer';
    }

    /*
    |--------------------------------------------------------------------------
    | Project Permission Helper
    |--------------------------------------------------------------------------
    */

    /**
     * Admin can manage all projects.
     * Engineers can manage only assigned projects.
     * Viewers cannot manage projects.
     */
    public function canManageProject(Project $project): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        if ($this->isEngineer()) {
            return strtoupper(trim($this->engineer_name ?? ''))
                === strtoupper(trim($project->project_engineer ?? ''));
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function projects()
    {
        return $this->hasMany(Project::class, 'assigned_engineer_id');
    }
}