<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 11:53
 */

namespace App\Extensions;
use Illuminate\Http\Request;

trait AuthenticatesLogout {

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->forget($this->guard()->getName());
        $request->session()->regenerate();

        $redirect = strpos($this->guard()->getName(),'_admin_') !== false ? route('admin.login') : '/';
        return redirect($redirect);
    }
}