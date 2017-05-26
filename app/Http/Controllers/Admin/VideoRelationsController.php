<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\VideoRelationForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Models\Video;
use CodeFlix\Repositories\Interfaces\VideoRepository;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class VideoRelationsController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(Video $video)
    {
        $form = FormBuilder::create(VideoRelationForm::class, [
            'url' => route('admin.videos.relations.store', ['video' => $video->id]),
            'method' => 'POST',
            'model' => $video
        ]);

        return view('admin.videos.relation', compact('form'));
    }


    public function store($id)
    {
        $form = FormBuilder::create(VideoRelationForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        session()->flash('message', 'Video alterado com sucesso.');
        return redirect()->back();
    }
}
