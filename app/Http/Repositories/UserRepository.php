<?php

namespace Repositories;


class UserRepository extends BaseRepository
{

    /**
     * Determine the model of the repository
     *
     */
    public function model()
    {
        return 'Models\User';
    }

    public function login($email,$password)
    {
        $user = $this->model->selectRaw("*")
            ->where('email', $email)
            ->where('password',$password)
            ->first();

        return $user;
    }

    public function getUserByEmail($email)
    {
        $user = $this->model->selectRaw("*")
                ->where('email', $email)->first();
        return $user;
    }

}