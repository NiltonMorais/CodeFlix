<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\VideoUploadForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Models\Video;
use CodeFlix\Repositories\Interfaces\VideoRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class VideoUploadsController extends Controller
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
        $form = FormBuilder::create(VideoUploadForm::class, [
            'url' => route('admin.videos.uploads.store', ['video' => $video->id]),
            'method' => 'POST',
            'model' => $video
        ]);

        return view('admin.videos.upload', compact('form'));
    }


    public function store(Request $request, Video $video)
    {
        $form = FormBuilder::create(VideoUploadForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        if($request->file('thumb')){
            $this->repository->uploadThumb($video,$request->file('thumb'));
        }

        if($request->file('file')){
            $this->repository->uploadFile($video,$request->file('file'));
        }

        $this->repository->update(['duration' => $request->get('duration')],$video->id);

        session()->flash('message', 'Upload realizado com sucesso.');
        return redirect()->route('admin.videos.uploads.create',['video'=>$video->id  ]);
    }
}
