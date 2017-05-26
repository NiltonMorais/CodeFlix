<?php

namespace CodeFlix\Media;


trait SeriePaths
{
    use VideoStorages;

    public function getThumbFolderStorageAttribute()
    {
        return "series/{$this->id}";
    }

    public function getThumbRelativeAttribute()
    {
        return "{$this->thumb_folder_storage}/{$this->thumb}";
    }

    public function getThumbPathAttribute()
    {
        return $this->getAbsolutePath($this->getStorageDisk(),$this->thumb_relative);
    }

    public function getThumbSmallRelativeAttribute()
    {
        list($name,$extension) = explode('.',$this->thumb);
        $filePath = "{$this->thumb_folder_storage}/{$name}_small.{$extension}";
        /*if(!\Storage::exists($filePath)){
            return 'small_'.env('THUMBNAIL_DEFAULT');
        }*/
        return $filePath;
    }

    public function getThumbSmallPathAttribute()
    {
        return $this->getAbsolutePath($this->getStorageDisk(),$this->thumb_small_relative);
    }

    public function getThumbAssetAttribute()
    {
        return route('admin.series.thumb_asset',['serie'=>$this->id]);
    }
    public function getThumbSmallAssetAttribute()
    {
        return route('admin.series.thumb_small_asset',['serie'=>$this->id]);
    }
}