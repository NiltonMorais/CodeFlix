@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de videos</h3>
        {!! Button::primary('Novo video')->asLinkTo(route('admin.videos.create')) !!}
    </div>
    <div class="row">
        {!!
            Table::withContents($videos->items())->striped()
            ->callback('Descrição', function($field,$video){
                return MediaObject::withContents(
                    [
                        'image' => $video->thumb_small_asset,
                        'link'  => $video->file_asset,
                        'heading'  => $video->title,
                        'body'  => $video->description
                    ]
                );
            })
            ->callback('Ações', function($field,$video){
                $linkEdit = route('admin.videos.edit',['category'=>$video->id]);
                $linkShow = route('admin.videos.show',['category'=>$video->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit)
                    .'|'.
                    Button::link(Icon::create('trash'))->asLinkTo($linkShow);
            })
        !!}
        {!! $videos->links() !!}
    </div>
</div>
@endsection

@push('styles')
<style type="text/css">
    .media-body{
        width: 400px;
    }
</style>
@endpush

