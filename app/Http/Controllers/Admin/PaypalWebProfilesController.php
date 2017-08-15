<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\PaypalWebProfileForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Models\PaypalWebProfile;
use CodeFlix\Repositories\Interfaces\PaypalWebProfileRepository;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class PaypalWebProfilesController extends Controller
{
    /**
     * @var PaypalWebProfileRepository
     */
    private $repository;

    public function __construct(PaypalWebProfileRepository $repository)
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
        $data = $this->repository->paginate();
        return view('admin.web_profiles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(PaypalWebProfileForm::class, [
            'url' => route('admin.web_profiles.store'),
            'method' => 'POST'
        ]);

        return view('admin.web_profiles.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(PaypalWebProfileForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->create(array_except($data, 'code'));
        session()->flash('message', 'Perfil Web PayPal criado com sucesso.');
        return redirect()->route('admin.web_profiles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param PaypalWebProfile $web_profile
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function show(PaypalWebProfile $web_profile)
    {
        return view('admin.web_profiles.show', compact('web_profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PaypalWebProfile $web_profile
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function edit(PaypalWebProfile $web_profile)
    {
        $form = FormBuilder::create(PaypalWebProfileForm::class, [
            'url' => route('admin.web_profiles.update', ['web_profile' => $web_profile->id]),
            'method' => 'PUT',
            'model' => $web_profile
        ]);

        return view('admin.web_profiles.edit', compact('form'));
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
        $form = FormBuilder::create(PaypalWebProfileForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        session()->flash('message', 'Perfil Web PayPal alterado com sucesso.');
        return redirect()->route('admin.web_profiles.index');
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
        session()->flash('message', 'Perfil Web PayPal excluído com sucesso.');
        return redirect()->route('admin.web_profiles.index');
    }
}
