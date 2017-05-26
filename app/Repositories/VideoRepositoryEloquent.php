<?php

namespace CodeFlix\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Repositories\Interfaces\VideoRepository;
use CodeFlix\Models\Video;
use CodeFlix\Validators\VideoValidator;

/**
 * Class VideoRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        if(isset($attributes['categories'])){
            $model->categories()->sync($attributes['categories']);
        }
        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Video::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
