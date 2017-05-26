<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class SerieForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');

        $rulesThumbFile = 'image|max:2048';
        $rulesThumbFile = !$id? "required|{$rulesThumbFile}" : $rulesThumbFile;

        $this
            ->add('title', 'text',[
                'label' => 'Título',
                'rules' => 'required|max:255',
            ])
            ->add('description', 'textarea',[
                'label' => 'Descrição',
                'rules' => 'required|max:255',
            ])
            ->add('thumb_file', 'file',[
                'required' => !$id?true:false,
                'label' => 'Capa',
                'rules' => $rulesThumbFile,
            ]);
    }
}
