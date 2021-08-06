<?php


namespace App\Services;


use App\Models\User;

class CheckEmailService
{
    /**
     * @param $email
     * @param null|int $id
     * @return bool
     */
    public function validaEmail($email, $id = null)
    {
        if ($id){
            $userEmail = User::select('email')->where('id', $id)->first();
            if ($userEmail->email == $email)
                return true;
        }

        if (User::where('email', $email)->exists())
            return false;

        return true;
    }
}
