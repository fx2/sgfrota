<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class CountryController extends Controller
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
    public function __construct(Country $country)
    {
        $this->middleware('auth');
        $this->middleware('checksetor:', ['only' => ['index']]);
        $this->middleware('checksetor:', ['only' => ['create']]);
        $this->middleware('checksetor:', ['only' => ['edit']]);
        $this->middleware('checksetor:', ['only' => ['destroy']]);
        $this->middleware('checksetor:', ['only' => ['relatorio']]);

        $this->model = $country;
        $this->saveSetorScope = false;
        $this->path = 'admin.country';
        $this->redirectPath = 'country';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/country';
        $this->validations = [];
        $this->pdfFields = [['id']];
        $this->pdfTitles = ['Id'];
        $this->indexFields = [['id']];
        $this->indexTitles = ['Id'];
    }

}
