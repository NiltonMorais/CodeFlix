<?php

namespace CodeFlix\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

trait FileUploads
{
    public function uploadFile(Model $model, UploadedFile $file)
    {
        $fileName = $this->upload($model, $file, 'file');
        if ($fileName) {
            $this->deleteFileOld($model);
            $model->file = $fileName;
            $model->save();
        }
        return $model;
    }

    protected function deleteFileOld($model)
    {
        $storage = $model->getStorageDisk();
        if ($storage->exists($model->file_relative)) {
            $storage->delete($model->file_relative);
        }
    }
}