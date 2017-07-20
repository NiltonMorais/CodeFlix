@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Visualizar plano</h3>
            <?php
            $iconEdit = Icon::create('pencil');
            $iconRemove = Icon::create('trash');
            ?>
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.plans.edit',['plan'=>$plan->id])) !!}
            {!!
                Button::danger($iconRemove)
                ->asLinkTo(route('admin.plans.destroy',['plan'=>$plan->id]))
                ->addAttributes(['onclick'=>"event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
            <?php $formDelete = FormBuilder::plain([
                'id' => 'form-delete',
                'method' => 'DELETE',
                'style' => 'display:none',
                'route'=>['admin.plans.destroy','plan'=>$plan->id]
            ]);?>
            {!! form($formDelete) !!}
            <br/><br/>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$plan->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$plan->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$plan->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
