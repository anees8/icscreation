<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model,SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsToMany};
use App\Models\{Role};


class Permission extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
  
    ];

    


    public function roles():BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
     
}
