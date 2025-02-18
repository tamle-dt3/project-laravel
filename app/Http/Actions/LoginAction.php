<?php
namespace App\Http\Actions;

use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function execute($data)
    {
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return Auth::user();
        }

        return null; // Trả về null nếu thông tin đăng nhập không hợp lệ
    }
}