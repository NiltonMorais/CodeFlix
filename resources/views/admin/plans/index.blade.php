@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem de planos</h3>
        {!! Button::primary('Novo plano')->asLinkTo(route('admin.plans.create')) !!}
    </div>
    <div class="row">
        {!!
            Table::withContents($plans->items())->striped()
            ->callback('Ações', function($field,$plan){
                $linkEdit = route('admin.plans.edit',['category'=>$plan->id]);
                $linkShow = route('admin.plans.show',['category'=>$plan->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit)
                    .'|'.
                    Button::link(Icon::create('trash'))->asLinkTo($linkShow);
            })
        !!}
        {!! $plans->links() !!}
    </div>
</div>
@endsection
