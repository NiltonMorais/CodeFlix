<?php

namespace CodeFlix\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;

trait ThumbUploads
{
    public function uploadThumb(Model $model, UploadedFile $file)
    {
        $fileName = $this->upload($model, $file, 'thumb');
        if ($fileName) {
            $this->deleteThumbsOld($model);
            $model->thumb = $fileName;
            $this->makeThumbSmall($model);
            $model->save();
        }
        return $model;
    }

    protected function makeThumbSmall($model)
    {
        $storage = $model->getStorageDisk();
        $thumbFile = $model->thumb_path;
        $format = \Image::format($thumbFile);
        $thumbnailSmall = \Image::open($thumbFile)->thumbnail(new Box(200, 144));
        $storage->put($model->thumb_small_relative, $thumbnailSmall->get($format));
    }

    protected function deleteThumbsOld($model)
    {
        $storage = $model->getStorageDisk();
        if ($storage->exists($model->thumb_relative) && $model->thumb != env('THUMBNAIL_DEFAULT')) {
            $storage->delete([$model->thumb_relative, $model->thumb_small_relative]);
        }
    }
}