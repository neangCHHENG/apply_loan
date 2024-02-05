<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class Role extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'name', 'isAdmin', 'description', 'maker', 'delby'
    ];

    protected $dates = ['deleted_at'];

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'role_permission');
    }
}
