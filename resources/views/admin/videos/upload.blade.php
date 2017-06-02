@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @component('admin.videos.tabs-component',['video'=>$form->getModel()])
                <div class="col-md-12">
                    <h3>Capa e arquivo de vídeo</h3>
                    <?php $icon = Icon::create('pencil'); ?>
                    {!! form($form->add('salve','submit',[
                        'attr' => ['class'=>'btn-lg btn btn-primary btn-block','title'=>'Salvar'],
                        'label' => $icon
                    ])) !!}
                </div>
            @endcomponent
        </div>
    </div>
@endsection
