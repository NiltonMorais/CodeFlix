<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\VideoForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Http\Controllers\Response;
use CodeFlix\Models\Video;
use Illuminate\Http\Request;

use CodeFlix\Http\Requests;
use Kris\LaravelFormBuilder\Facades\FormBuilder;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodeFlix\Http\Requests\VideoCreateRequest;
use CodeFlix\Http\Requests\VideoUpdateRequest;
use CodeFlix\Repositories\Interfaces\VideoRepository;


class VideosController extends Controller
{

    /**
     * @var VideoRepository
     */
    protected $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->repository->paginate();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(VideoForm::class, [
            'url' => route('admin.videos.store'),
            'method' => 'POST'
        ]);

        return view('admin.videos.create', compact('form'));
    }

    public function store()
    {
        $form = FormBuilder::create(VideoForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $video = $this->repository->create($data);
        session()->flash('message', 'Video cadastrado com sucesso.');
        return redirect()->route('admin.videos.relations.create',['id'=>$video->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Video $video
     * @return \Illuminate\Http\Response
     * @internal param Video $video
     * @internal param User $user
     */
    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Video $video
     * @return \Illuminate\Http\Response
     * @internal param Video $video
     * @internal param User $user
     */
    public function edit(Video $video)
    {
        $form = FormBuilder::create(VideoForm::class, [
            'url' => route('admin.videos.update', ['video' => $video->id]),
            'method' => 'PUT',
            'model' => $video
        ]);

        return view('admin.videos.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param User $user
     */
    public function update($id)
    {
        $form = FormBuilder::create(VideoForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        session()->flash('message', 'Video alterado com sucesso.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        session()->flash('message', 'Video excluído com sucesso.');
        return redirect()->route('admin.videos.index');
    }

    public function fileAsset(Video $video)
    {
        return response()->download($video->file_path);
    }

    public function thumbAsset(Video $video)
    {
        return response()->download($video->thumb_path);
    }

    public function thumbSmallAsset(Video $video)
    {
        return response()->download($video->thumb_small_path);
    }
}
