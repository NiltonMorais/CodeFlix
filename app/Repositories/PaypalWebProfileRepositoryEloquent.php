<?php

namespace CodeFlix\Repositories;

use CodeFlix\Models\PaypalWebProfile;
use CodeFlix\Repositories\Interfaces\PaypalWebProfileRepository;
use CodeFlix\Validators\PaypalWebProfileValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PaypalWebProfileRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class PaypalWebProfileRepositoryEloquent extends BaseRepository implements PaypalWebProfileRepository
{
    public function create(array $attributes)
    {
        $attributes['code'] = 'processing';
        parent::create($attributes);
    }

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
