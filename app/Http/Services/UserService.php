<?php

namespace Services;

use Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;
use \Illuminate\Database\Eloquent\Model;
use Helpers\SecurityHelper;


class UserService extends BaseService
{

    public function __construct(DatabaseManager $database, UserRepository $repository)
    {
        $this->setDatabase($database);
        $this->setRepository($repository);
    }

    public function prepareCreate(array $data)
    {
        $data["password"] = SecurityHelper::getHahedPassword($data["password"]);
        $user = $this->repository->create($data);
        return $user;
    }

    public function prepareUpdate(Model $model, array $data)
    {
        $this->repository->update($data, $model->id);
    }

    public function prepareDelete(int $id)
    {
        $this->repository->delete($id);
    }


    public function login($email, $password)
    {

        $user = $this->repository->getUserByEmail($email);

        if ($user) {
            if ($user->password == SecurityHelper::getHahedPassword($password)) {
                return $user;
            }
        } else {
            return null;
        }
    }

    

 
}