@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de perfis web do PayPal</h3>
        {!! Button::primary('Novo perfil PayPal')->asLinkTo(route('admin.web_profiles.create')) !!}
    </div>
    <div class="row">
        {!!
            Table::withContents($data->items())->striped()
            ->callback('Ações', function($field,$item){
                $linkEdit = route('admin.web_profiles.edit',['web_profile'=>$item->id]);
                $linkShow = route('admin.web_profiles.show',['web_profile'=>$item->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit)
                    .'|'.
                    Button::link(Icon::create('trash'))->asLinkTo($linkShow);
            })
        !!}
        {!! $data->links() !!}
    </div>
</div>
@endsection
