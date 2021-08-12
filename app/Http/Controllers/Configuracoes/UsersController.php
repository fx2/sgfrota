<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\User;
use App\Services\CheckEmailService;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    use CrudControllerTrait;

    private $model;
    private $path;
    private $redirectPath;
    private $checkEmailService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users, CheckEmailService $checkEmailService)
    {
        $this->middleware('auth');
        $this->checkEmailService = $checkEmailService;
//        $this->middleware('checksetor:', ['only' => ['index']]);
//        $this->middleware('checksetor:', ['only' => ['create']]);
//        $this->middleware('checksetor:', ['only' => ['edit']]);
//        $this->middleware('checksetor:', ['only' => ['destroy']]);
//        $this->middleware('checksetor:', ['only' => ['relatorio']]);

        $this->model = $users;
        $this->saveSetorScope = true;
        $this->path = 'configuracoes.users';
        $this->redirectPath = 'users';
        $this->withFields = ['setor', 'perfil'];
        $this->selectModelFields = [
            'Setor' => '\App\Models\Setor',
            'Perfil' => '\App\Models\Perfil'
        ];
        $this->joinSearch = [
            'setor_id' => ['nome', '\App\Models\Setor'],
            'perfil_id' => ['nome', '\App\Models\Perfil']
        ];
        $this->uploadFilePath = 'images/users';
        $this->validations = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:9',
            'perfil_id' => 'required',
            'setor_id' => 'required',
        ];
        $this->fileName = ['foto_perfil'];
        $this->uploadFilePath = 'images/usuarios';
        $this->pdfFields = [['name'], ['email'], ['perfil', 'nome']];
        $this->pdfTitles = ['Nome', 'Email', 'Perfil'];
        $this->indexFields = [['name'], ['email'], ['perfil', 'nome']];
        $this->indexTitles = ['nome', 'Email', 'Perfil'];

                $this->pdfTitle = 'Usuáriosde';

    }

    public function store(Request $request)
    {
        $userAuth = auth('api')->user();

        if (!empty($this->validations)) {
            $this->validate($request, $this->validations);
        }

        $requestData = $request->all();
        $requestData["password"] = Hash::make($requestData["password"]);

        if(!$this->checkEmailService->validaEmail($requestData['email'])){
            toastr()->error('Email já está sendo usado por outro usuário.');
            return redirect()->back();
        }

        if ($this->saveSetorScope){
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin')
                $requestData['setor_id'] = $userAuth->setor_id;
        }

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        $this->model->create($requestData);
        return redirect($this->redirectPath)->withInput();
    }

    public function update(Request $request, $id)
    {
        $userAuth = auth('api')->user();

        if (!empty($this->validations)) {
            foreach ($this->fileName as $key => $value) {
                unset($this->validations[$value]);
            }

            $this->validate($request, $this->validations);
        }

        if ($this->saveSetorScope){
            if ($userAuth->type !== 'master' AND $userAuth->type !== 'admin')
                $requestData['setor_id'] = $userAuth->setor_id;
        }

        $result = $this->model->findOrFail($id);
        $requestData = $request->all();

        $requestData['password'] = Hash::make($requestData['password']);

        if(!$this->checkEmailService->validaEmail($requestData['email'], $id)){
            toastr()->error('Email já está sendo usado por outro usuário.');
            return redirect()->back();
        }

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        $result->update($requestData);
        toastr()->success('Sucesso.');

        return redirect($this->redirectPath)->withInput();
    }

}
