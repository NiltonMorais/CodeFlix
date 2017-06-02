<?php

namespace CodeFlix\Repositories;

use CodeFlix\Media\FileUploads;
use CodeFlix\Media\ThumbUploads;
use CodeFlix\Media\Uploads;
use CodeFlix\Models\Video;
use CodeFlix\Repositories\Interfaces\VideoRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class VideoRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    use ThumbUploads, FileUploads, Uploads;

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        if (isset($attributes['categories'])) {
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
