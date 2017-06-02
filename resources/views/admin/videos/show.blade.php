@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Visualizar video</h3>
            <?php
            $iconEdit = Icon::create('pencil');
            $iconRemove = Icon::create('trash');
            ?>
            {!! Button::primary($iconEdit)->asLinkTo(route('admin.videos.edit',['video'=>$video->id])) !!}
            {!!
                Button::danger($iconRemove)
                ->asLinkTo(route('admin.videos.destroy',['video'=>$video->id]))
                ->addAttributes(['onclick'=>"event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
            <?php $formDelete = FormBuilder::plain([
                'id' => 'form-delete',
                'method' => 'DELETE',
                'style' => 'display:none',
                'route'=>['admin.videos.destroy','video'=>$video->id]
            ]);?>
            {!! form($formDelete) !!}
            <br/><br/>

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">Capa</th>
                    <td>
                        <img src="{{$video->thumb_asset}}" height="360">
                    </td>
                </tr>
                <tr>
                    <th scope="row">Video</th>
                    <td>
                        <a href="{{$video->file_asset}}" target="_blank">Download</a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">#</th>
                    <td>{{$video->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Título</th>
                    <td>{{$video->title}}</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>{{$video->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
