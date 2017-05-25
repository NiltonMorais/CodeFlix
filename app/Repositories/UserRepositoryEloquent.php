<?php

namespace CodeFlix\Repositories;

use CodeFlix\Models\User;
use CodeFlix\Repositories\Interfaces\UserRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function create(array $attributes)
    {
        $attributes['role'] = User::ROLE_ADMIN;
        $attributes['password'] = User::generatePassword(isset($attributes['password']) ? $attributes['password'] : null);
        $model = parent::create($attributes);
        \UserVerification::generate($model);
        \UserVerification::send($model,"Sua conta foi criada");
        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
