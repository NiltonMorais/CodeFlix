<?php

namespace CodeFlix\Media;


trait ThumbsData
{
    public function getThumbs()
    {
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/thumbs/teste.jpg'),
                'teste.jpg'
            ),
        ]);
    }
}