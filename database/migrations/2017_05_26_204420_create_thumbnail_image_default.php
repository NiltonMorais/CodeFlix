<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThumbnailImageDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $storage = $this->getStorageDrive();
        $fileName = $this->getFileName();

        $file = new \Illuminate\Http\UploadedFile(
            storage_path("app/files/{$fileName}"),
            $fileName
        );

        $format = \Image::format($file);
        $thumbnailSmall = \Image::open($file)->thumbnail(new \Imagine\Image\Box(64,36));
        $storage->put("small_{$fileName}",$thumbnailSmall->get($format));

        $storage->putFileAs("/",$file,$fileName);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $storage = $this->getStorageDrive();
        $fileName = $this->getFileName();

        $storage->delete($fileName);
        $storage->delete("small_{$fileName}");
        echo "** Imagem {$fileName} deletada\n";
        echo "** Imagem small_{$fileName} deletada\n";
    }

    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    protected function getStorageDrive()
    {
        return \Storage::disk(config('filesystems.default'));
    }

    protected function getFileName()
    {
        return env("THUMBNAIL_DEFAULT");
    }
}
