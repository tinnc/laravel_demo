<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Helper;
use Carbon\Carbon;
//Notification for Seller
use App\Notifications\SellerResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
     protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'birthday',
    ];

    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SellerResetPasswordNotification($token));
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id', 'parent_id');
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function getPhoneNumberFormatAttribute()
    {
        $helper = new Helper($this->phone_number);

        return $helper->phone_number_format;
    }

    public function getBirthdayFormatAttribute()
    {
        if ($this->birthday) {
            return Carbon::parse($this->birthday)->format('d/m/Y');
        }
        return $this->birthday;
    }

    public function getImageFormatAttribute()
    {
        if ($this->image) {
            return $this->image;
        }
        return 'no_img.png';
    }

    public function getStatusFormatAttribute()
    {
        if ($this->status == 1) {
            return 'checked.jpg';
        }
        return 'banned.jpg';
    }

    public function getRoleFormatAttribute()
    {
        if ($this->role) {
            return ucfirst($this->role->name);
        }
        return '';
    }

    public function getGenderFormatAttribute()
    {
        if ($this->gender == 1) {
            return 'Female';
        }
        return 'Male';
    }

}
