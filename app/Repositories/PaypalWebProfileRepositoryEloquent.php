<?php

namespace CodeFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Repositories\Interfaces\PaypalWebProfileRepository;
use CodeFlix\Models\PaypalWebProfile;
use CodeFlix\Validators\PaypalWebProfileValidator;

/**
 * Class PaypalWebProfileRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class PaypalWebProfileRepositoryEloquent extends BaseRepository implements PaypalWebProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PaypalWebProfile::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
