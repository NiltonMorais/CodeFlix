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
        \DB::beginTransaction();
        try {
            $model = parent::create($attributes);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
        \DB::commit();
        return $model;
    }

    public function update(array $attributes, $id)
    {
        \DB::beginTransaction();
        try {
            $model = parent::update($attributes, $id);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
        \DB::commit();
        return $model;
    }

    public function delete($id)
    {
        \DB::beginTransaction();
        try {
            $result = parent::delete($id);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
        \DB::commit();
        return $result;
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
