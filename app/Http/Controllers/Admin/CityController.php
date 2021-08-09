<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\City;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class CityController extends Controller
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
    public function __construct(City $city)
    {
        $this->middleware('auth');
        $this->middleware('checksetor:', ['only' => ['index']]);
        $this->middleware('checksetor:', ['only' => ['create']]);
        $this->middleware('checksetor:', ['only' => ['edit']]);
        $this->middleware('checksetor:', ['only' => ['destroy']]);
        $this->middleware('checksetor:', ['only' => ['relatorio']]);

        $this->model = $city;
        $this->saveSetorScope = false;
        $this->path = 'admin.city';
        $this->redirectPath = 'city';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/city';
        $this->validations = [];
        $this->pdfFields = [['id']];
        $this->pdfTitles = ['Id'];
        $this->indexFields = [['id']];
        $this->indexTitles = ['Id'];
    }

}
