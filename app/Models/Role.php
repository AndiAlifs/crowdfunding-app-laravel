<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class Role extends Model
{
    use HasFactory, UsesUuid;
    protected $guarded=[];
    public $timestamps = false;
    
    public function user()
    {
        return $this->hasMany('User');
    }
}
