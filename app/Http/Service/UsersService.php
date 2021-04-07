<?php


namespace App\Http\Service;

use App\Models\User;

class UsersService
{
    /**
     * @param array $user_data
     * @return User
     */
    public function getUser(array $user_data): User
    {
        $user = User::where('email' , $user_data['email'])->first();

        if(!$user){
            $user = new User;
            $user->name = $user_data['name'];
            $user->email = $user_data['email'];
            $user->password = bcrypt('password');
            $user->save();
        }

        return $user;
    }
}
