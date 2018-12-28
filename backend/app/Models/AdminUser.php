<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class AdminUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','password','name','email','file_id','avatar','remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_user_role_pivots', 'user_id', 'role_id');
    }

    public function getRoleLinksAttribute(){
        $html = '';
        $colors = ['primary','info','success','warning','danger','mint','purple','pink'];
        if (!$this->roles->isEmpty()) {
            foreach ($this->roles as $role) {
                $html .= '<a href="' . route('adminUser.index', ['role_id' => $role->id]) . '" title="' . $role->name . '" target="_blank" class=""><span class="label label-'.array_random($colors).'">' . $role->name . '</span></a>&nbsp;';
            }
            $html = rtrim($html, '&nbsp;');
        }else{
            $html = '--';
        }

        return $html;
    }
}