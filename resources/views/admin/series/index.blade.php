@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de séries</h3>
        {!! Button::primary('Nova série')->asLinkTo(route('admin.series.create')) !!}
    </div>
    <div class="row">
        {!!
           Table::withContents($series->items())->striped()
           ->callback('Descrição', function($field,$serie){
               return MediaObject::withContents(
                   [
                       'image' => $serie->thumb_small_asset,
                       'link'  => '#',
                       'heading'  => $serie->title,
                       'body'  => $serie->description
                   ]
               );
           })
           ->callback('Ações', function($field,$serie){
                $linkEdit = route('admin.series.edit',['serie'=>$serie->id]);
                $linkShow = route('admin.series.show',['serie'=>$serie->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit)
                    .'|'.
                    Button::link(Icon::create('trash'))->asLinkTo($linkShow);
            })
       !!}
        {!! $series->links() !!}
    </div>
</div>
@endsection

@push('styles')
    <style type="text/css">
        table > thead > tr > th:nth-child(3){
            width: 60%;
        }
    </style>
@endpush
