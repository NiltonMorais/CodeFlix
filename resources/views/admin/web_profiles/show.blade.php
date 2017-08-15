@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Visualizar perfil PayPal</h3>
            <?php
            $iconEdit = Icon::create('pencil');
            $iconRemove = Icon::create('trash');
            ?>
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.web_profiles.edit',['web_profile'=>$web_profile->id])) !!}
            {!!
                Button::danger($iconRemove)
                ->asLinkTo(route('admin.web_profiles.destroy',['web_profile'=>$web_profile->id]))
                ->addAttributes(['onclick'=>"event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
            <?php $formDelete = FormBuilder::plain([
                'id' => 'form-delete',
                'method' => 'DELETE',
                'style' => 'display:none',
                'route'=>['admin.web_profiles.destroy','web_profile'=>$web_profile->id]
            ]);?>
            {!! form($formDelete) !!}
            <br/><br/>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$web_profile->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$web_profile->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Logo Url</th>
                    <td>{!! \BootstrapImage::thumbnail($web_profile->logo_url,'thumbnail') !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
