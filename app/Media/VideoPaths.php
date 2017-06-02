<?php

namespace CodeFlix\Media;


trait VideoPaths
{
    use ThumbPaths;

    public function getThumbFolderStorageAttribute()
    {
        return "videos/{$this->id}";
    }

    public function getFileFolderStorageAttribute()
    {
        return "videos/{$this->id}";
    }

    public function getFileAssetAttribute()
    {
        return $this->isLocalDriver() ?
            route('admin.videos.file_asset',['video'=>$this->id])
            : $this->file_path;
    }

    public function getFileRelativeAttribute()
    {
        return $this->file ? "{$this->file_folder_storage}/{$this->file}" : false;
    }

    public function getFilePathAttribute()
    {
        if($this->file_relative) {
            return $this->getAbsolutePath($this->getStorageDisk(), $this->file_relative);
        }
        return false;
    }

    public function getThumbAssetAttribute()
    {
        return $this->isLocalDriver() ?
            route('admin.videos.thumb_asset',['video'=>$this->id])
            : $this->thumb_path;
    }

    public function getThumbSmallAssetAttribute()
    {
        return $this->isLocalDriver() ?
            route('admin.videos.thumb_small_asset',['video'=>$this->id])
            : $this->thumb_small_path;
    }
}