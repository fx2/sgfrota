<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\State;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class StateController extends Controller
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
    public function __construct(State $state)
    {
        $this->middleware('auth');
        $this->middleware('checksetor:', ['only' => ['index']]);
        $this->middleware('checksetor:', ['only' => ['create']]);
        $this->middleware('checksetor:', ['only' => ['edit']]);
        $this->middleware('checksetor:', ['only' => ['destroy']]);
        $this->middleware('checksetor:', ['only' => ['relatorio']]);

        $this->model = $state;
        $this->path = 'admin.state';
        $this->saveSetorScope = false;
        $this->redirectPath = 'state';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/state';
        $this->validations = [];
        $this->pdfFields = [['id']];
        $this->pdfTitles = ['Id'];
        $this->indexFields = [['id']];
        $this->indexTitles = ['Id'];
    }

}
