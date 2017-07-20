<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\PlanForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Models\Plan;
use CodeFlix\Repositories\Interfaces\PlanRepository;
use Illuminate\Database\Eloquent\Model;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class PlansController extends Controller
{
    /**
     * @var PlanRepository
     */
    private $repository;

    /**
     * PlansController constructor.
     * @param PlanRepository $repository
     */
    public function __construct(PlanRepository $repository)
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
        $plans = $this->repository->paginate();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = FormBuilder::create(PlanForm::class, [
            'url' => route('admin.plans.store'),
            'method' => 'POST'
        ]);

        return view('admin.plans.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $form = FormBuilder::create(PlanForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        Model::unguard();
        $this->repository->create(array_except($data, 'code'));
        session()->flash('message', 'Plano criado com sucesso.');
        return redirect()->route('admin.plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \CodeFlix\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('admin.plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $form = FormBuilder::create(PlanForm::class, [
            'url' => route('admin.plans.update', ['plan' => $plan->id]),
            'method' => 'PUT',
            'model' => $plan,
        ]);

        return view('admin.plans.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param Plan $plan
     */
    public function update($id)
    {
        $form = FormBuilder::create(PlanForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, $id);
        session()->flash('message', 'Plano alterado com sucesso.');
        return redirect()->route('admin.plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Plan $plan
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        session()->flash('message', 'Plano excluído com sucesso.');
        return redirect()->route('admin.plans.index');
    }
}
