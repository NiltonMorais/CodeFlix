<?php

namespace CodeFlix\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SerieRepository
 * @package namespace CodeFlix\Repositories\Interfaces;
 */
interface SerieRepository extends RepositoryInterface
{
    public function uploadThumb(Model $model, UploadedFile $file);
}
