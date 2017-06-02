<?php

namespace CodeFlix\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VideoRepository
 * @package namespace CodeFlix\Repositories\Interfaces;
 */
interface VideoRepository extends RepositoryInterface
{
    public function uploadThumb(Model $model, UploadedFile $file);

    public function uploadFile(Model $model, UploadedFile $file);
}
