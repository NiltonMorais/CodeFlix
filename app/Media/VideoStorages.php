<?php

namespace CodeFlix\Media;

use Illuminate\Filesystem\FilesystemAdapter;

trait VideoStorages
{
    /**
     * @return FilesystemAdapter
     */
    public function getStorageDisk()
    {
        return \Storage::disk($this->getStorageDiskDriver());
    }

    protected function getStorageDiskDriver()
    {
        return config('filesystems.default');
    }

    protected function getAbsolutePath(FilesystemAdapter $storage, $fileRelativePath){
        return $storage->getDriver()->getAdapter()->applyPathPrefix($fileRelativePath);
    }
}