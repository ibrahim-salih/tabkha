<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Cooker extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['f_name','l_name','username','email','phone','phoneCash','image','ID_img_front','ID_img_back','package_id','start_date','end_date','freePackage','gender','confirm','work','prePay','COD','password','nationalty_id','country_id','state_id','address','last_seen','online','status'];

    public function nationalty(){
        return $this->belongsTo('App\Models\Nationality','nationalty_id');
    }

    public function package(){
        return $this->belongsTo('App\Models\Package','package_id');
    }
    ####### Begin Scopes ####################################
    public function scopeActive($query)
    {
        //get all active
        $query->where('status', '1');
    }
    public function scopeNotactive($query)
    {
        //get all active
        $query->where('status', '0');
    }
    public function scopeConfirm($query)
    {
        //get all active
        $query->where('confirm', '1');
    }
    public function scopeNotconfirm($query)
    {
        //get all active
        $query->where('confirm', '0');
    }
    ####### End Scopes ####################################
    ####### Begin Accessors & Mutators ####################################
    // public function getConfirmAttribute($val){
    //    return $val == '0' ? "غير مفعل" : " مفعل";
    // }
    // public function getOnlineAttribute($val){
    //     return $val == 'avilable' ? ' متاح' : 'غير متاح';
    // }
    ####### End Accessors & Mutators ####################################

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
