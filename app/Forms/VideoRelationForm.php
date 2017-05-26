<?php

namespace CodeFlix\Forms;

use CodeFlix\Models\Category;
use CodeFlix\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoRelationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('categories','entity',[
                'label' => 'Categorias',
                'class' => Category::class,
                'property' => 'name',
                'selected'  => $this->model?$this->model->categories->pluck('id')->toArray():null,
                'multiple' => true,
                'rules' => 'required|exists:categories,id',
                'attr' => [
                    'name' => 'categories[]'
                ]
            ])
            ->add('serie_id', 'entity',[
                'label' => 'Série',
                'class' => Serie::class,
                'property' => 'title',
                'empty_value' => 'Selecione a série',
                'rules' => 'nullable|exists:series,id'
            ]);
    }
}
