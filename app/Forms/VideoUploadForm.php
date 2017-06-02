<?php

namespace CodeFlix\Forms;

use CodeFlix\Models\Category;
use CodeFlix\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoUploadForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('thumb','file',[
                'required' => false,
                'label' => 'Capa',
                'rules' => 'image|max:2048',
            ])
             ->add('file','file',[
                'required' => false,
                'label' => 'Arquivo de vídeo',
                'rules' => 'mimetypes:video/mp4',
            ])
            ->add('duration','text',[
                'label' => 'Duração',
                'rules' => 'required|integer|min:1',
            ]);

    }
}
