<?php

namespace App\Repositories\Auth;

use Ichtrojan\Otp\Otp;
use App\Models\Admin;

class PasswordRepository
{
    /**
     * Create a new class instance.
     */
    protected $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function getAdminByEmail($email){
        $admin = Admin::where('email', $email)->first();
        return $admin;
    }

    public function verifyOtp($data){
        $otp = $this->otp->validate($data['email'] ,  $data['code']);
        return $otp;
    }

    public function resetPassword($email, $password){
        $admin = self::getAdminByEmail($email);
        $admin = $admin->update([
            'email'=>bcrypt($password)
        ]);
        return $admin;
    }

}
