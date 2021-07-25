<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\CrudControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use CrudControllerTrait;

    private $model;
    private $path;
    private $redirectPath;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->model = $user;
        $this->path = 'admin.user';
        $this->redirectPath = 'user';
        $this->pdfFields = [['name'],['email']];
        $this->pdfTitles = ['Nome','Email'];
        $this->indexFields = [['Name'],['email']];
        $this->indexTitles = ['Name','email'];
        $this->validations = [
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:9',
        ];
        $this->fileName = ['foto'];
    }

    public function index()
    {
        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $user = auth()->user();

        if ($id != $user->id)
            return redirect()->back();

        $result = $this->model
          ->findOrFail($id);

        return view($this->path.'.edit', ['result'=>$result, 'withFields' => $this->withFields($result), 'selectModelFields' => $this->selectModelFields()]);
    }

    public function update(Request $request, $id)
    {
        if (!empty($this->validations)) {
            foreach ($this->fileName as $key => $value) {
                unset($this->validations[$value]);
            }

            $this->validate($request, $this->validations);
        }

        $result = $this->model->findOrFail($id);
        $requestData = $request->all();

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        $requestData['password'] = Hash::make($requestData['password']);

        $result->update($requestData);
        toastr()->success('Seus dados de usuário foram salvos com sucesso.');

        return redirect()->back();
    }
}
