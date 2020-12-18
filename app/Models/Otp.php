<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUuid;

class Otp extends Model
{
    use HasFactory, UsesUuid;
    protected $guarded=[];

    public static function boot(){
        parent::boot();
        static::creating(function ($model){
            $model->otp = rand(10000,99999);
            $timeExpired = \Carbon\Carbon::now();
            $timeExpired->minute += 2;
            $model->time_expired = $timeExpired->toDateTimeString();
        });
    }

    public function user()
    {
        return $this->hasOne('User');
    }
}
