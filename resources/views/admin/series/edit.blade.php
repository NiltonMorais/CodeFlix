@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h3>Editar série</h3>
        <?php $icon = Icon::create('pencil'); ?>
        {!! form($form->add('salve','submit',[
            'attr' => ['class'=>'btn-lg btn btn-primary btn-block','title'=>'Salvar'],
            'label' => $icon
        ])) !!}
    </div>
</div>
@endsection
