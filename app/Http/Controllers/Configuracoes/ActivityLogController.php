<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class ActivityLogController extends Controller
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
    public function __construct(ActivityLog $activitylog)
    {
        $this->middleware('auth');
        $this->middleware('checksetor:' . ACTIVITYLOG_VISUALIZAR, ['only' => ['index']]);
//        $this->middleware('checksetor:', ['only' => ['create']]);
//        $this->middleware('checksetor:', ['only' => ['edit']]);
//        $this->middleware('checksetor:', ['only' => ['destroy']]);
//        $this->middleware('checksetor:', ['only' => ['relatorio']]);

        $this->model = $activitylog;
        $this->path = 'configuracoes.activity-log';
        $this->redirectPath = 'activity-log';
        $this->withFields = [];
        $this->selectModelFields = [];
        $this->joinSearch = [];
        $this->fileName = [];
        $this->uploadFilePath = 'images/activity-log';
        $this->validations = [];
        $this->pdfFields = [['id']];
        $this->pdfTitles = ['Id'];
        $this->indexFields = [['id']];
        $this->indexTitles = ['Id'];
    }

    public function index(Request $request)
    {
        if ($request->search){
            $users = User::where('name', 'LIKE', "%{$request->search}%")->paginate(20);
        } else {
            $users = User::paginate(20);
        }

        return view($this->path . '.index', ['results' => $users]);
    }

    public function show($id)
    {
        $logactivitys = $this->model:: where('causer_id', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        $user = User::find($id);

        return view($this->path . '.show', ['logactivitys' => $logactivitys, 'user' => $user]);
    }

    public function edit($id)
    {
        $logactivity = $this->model::findOrFail($id);
        $properties = json_decode($logactivity['properties'], true);

        return view($this->path . '.edit', compact('logactivity', 'properties'));
    }
}
