<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Traits\UsesUuid;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UsesUuid;

    protected $guarded=[];


     /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    
    public function get_user_role_id(){
        $role = Role::where('name','user')->first();
        return $role->id;
    }

    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->role_id = $model->get_user_role_id();
        });
        static::created(function ($model){
            $new_otp = Otp::create(['user_id' => $model->id]);
            $model->otp_id = $new_otp->id;
            $model->save();
        });
    }

    public function regenerate_otp_code() {        
        $new_otp = Otp::create(['user_id' => $this->id]);
        $this->otp_id = $new_otp->id;
        $this->save();
    }
    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'email',
        'name',
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function otp()
    {
        return $this->hasOne('App\Models\Otp');
    }
}
