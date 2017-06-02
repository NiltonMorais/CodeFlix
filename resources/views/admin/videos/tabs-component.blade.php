<?php

$tabs = [
    [
        'title' => 'Informações',
        'link' => !isset($video)?route('admin.videos.create'):route('admin.videos.edit',['video'=>$video->id]),
    ],
    [
        'title' => 'Série e categoria',
        'link' => !isset($video)?'#':route('admin.videos.relations.create',['video'=>$video->id]),
        'disabled' => !isset($video)?true:false,
    ],
    [
        'title' => 'Video e capa',
        'link' => !isset($video)?'#':route('admin.videos.uploads.create',['video'=>$video->id]),
        'disabled' => !isset($video)?true:false,
    ],
];

?>
<h3>Gerenciar vídeo</h3>
<div class="text-right">
    {!! Button::link('Listar videos')->asLinkTo(route('admin.videos.index')) !!}
</div>
{!! Navigation::tabs($tabs) !!}
<div>
    {!! $slot !!}
</div>

