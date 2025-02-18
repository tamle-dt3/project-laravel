<?php
namespace App\Http\Actions;

use App\Models\User;

class RegisterAction
{
    public function execute($data)
    {
        return User::create([
            'name' => $data["name"],
            'email' => $data["email"],
            'password' => bcrypt($data["password"]),
        ]);
    }
}