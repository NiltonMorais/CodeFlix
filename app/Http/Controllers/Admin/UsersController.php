<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\UserForm;
use CodeFlix\Models\User;
use CodeFlix\Repositories\Interfaces\UserRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
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
        $users = $this->repository->paginate();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(UserForm::class,[
            'url' => route('admin.users.store'),
            'method' => 'POST'
        ]);

        return view('admin.users.create',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = FormBuilder::create(UserForm::class);

        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $data['role'] = User::ROLE_ADMIN;
        $this->repository->create($data);
        session()->flash('message','Usuário criado com sucesso.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = FormBuilder::create(UserForm::class,[
            'url' => route('admin.users.update',['user'=>$user->id]),
            'method' => 'PUT',
            'model' => $user
        ]);

        return view('admin.users.edit',compact('form'));
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
        $form = FormBuilder::create(UserForm::class,[
            'data' =>   ['id' => $id]
        ]);

        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = array_except($form->getFieldValues(),['password','role']);
        $this->repository->update($data, $id);
        session()->flash('message','Usuário alterado com sucesso.');
        return redirect()->route('admin.users.index');
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
        session()->flash('message','Usuário excluído com sucesso.');
        return redirect()->route('admin.users.index');
    }
}
