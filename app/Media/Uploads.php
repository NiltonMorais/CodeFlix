<?php

namespace CodeFlix\Media;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;

trait Uploads
{
    public function upload($model, UploadedFile $file, $type){
        /**
         * @var FilesystemAdapter $storage
         */
        $storage = $model->getStorageDisk();

        $fileName = md5(time()."{$model->id}-{$file->getClientOriginalName()}").".{$file->guessExtension()}";

        $result = $storage->putFileAs($model->{"{$type}_folder_storage"},$file,$fileName);
        return $result ? $fileName : false;
    }
}