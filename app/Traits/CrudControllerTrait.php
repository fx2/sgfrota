<?php

namespace App\Traits;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

trait CrudControllerTrait
{
    /**
     * Display a listing of the resource.
     * ?limit=20
     * ?order=title,asc
     * ?field=value -> where
     * ?like=field,value
     * ?where=field,condition,value
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->all()['limit'] ?? 20;

        $result = $this->model;

        if (isset($request->all()['select'])) {
            $result = $this->select($request->all()['select'], $result);
        }

        if (isset($request->all()['order'])) {
            $result = $this->order($request->all()['order'], $result);
        }

        if (isset($request->all()['join'])) {
            $result = $this->join($request->all()['join'], $result);
        }

        if (isset($request->all()['leftJoin'])) {
            $result = $this->leftJoin($request->all()['leftJoin'], $result);
        }

        if (isset($request->all()['rightJoin'])) {
            $result = $this->rightJoin($request->all()['rightJoin'], $result);
        }

        if (isset($request->all()['like'])) {
            $result = $this->like($request->all()['like'], $result);
        }

        if(isset($request->all()['with'])) {
            $result = $this->with($request->all()['with'], $result);
        }

        if(isset($request->all()['groupBy'])) {
            $result = $this->groupBy($request->all()['groupBy'], $result);
        }

        $result= $result->with($this->relationships());

        if(isset($request->all()['where'])) {
            $result = $this->where($request->all()['where'], $result);
        }

        if(isset($request->all()['orWhere'])) {
            $result = $this->orWhere($request->all()['orWhere'], $result);
        }

        if(isset($request->all()['search'])) {
            $result = $this->search($request->search, $result);
        }

        if(isset($request->all()['get'])) {
            return $result->get();
        }

        if(isset($request->all()['first'])) {
            return $result->first();
        }

        if ($request->export_pdf == "true")
            return $this->exportPdf($result);

        $result = $result->paginate($limit);

        return view($this->path.'.index', ['results'=>$result, 'fields' => $this->indexFields, 'titles' => $this->indexTitles]);
    }

    public function exportPdf($result)
    {
        $data = [
            'results' => $result->get(),
            'fields' => $this->pdfFields,
            'titles' => $this->pdfTitles,
            'valor' => ''
        ];

        $pdf = PDF::loadView('admin/pdf/relatoriosPDF', $data);
        $pdfModelName = str_replace("admin.", "", $this->path); // TODO mexer nesse admin. caso mude a pasta

        // return $pdf->download($pdfModelName . '.pdf');
        return $pdf->stream($pdfModelName . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path.'.create', ['selectModelFields' => $this->selectModelFields()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($this->validations)) {
            $this->validate($request, $this->validations);
        }

        $requestData = $request->all();

        if (!empty($this->checkboxExplode)) {
            $requestData = $this->saveCheckboxExplode($requestData);
        }

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        if (!empty($this->numbersWithDecimal)) {
            $requestData = $this->formatRemoveDecimal($requestData);
        }

        $this->model->create($requestData);
        return redirect($this->redirectPath)->withInput();
    }

    public function formatRemoveDecimal($requestData)
    {
        foreach ($this->numbersWithDecimal as $numbers){
            $requestData[$numbers] = str_replace('.', '', str_replace(',', '', $requestData[$numbers]));
        }

        return $requestData;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->model->with($this->relationships())
          ->findOrFail($id);
        return view($this->path.'.show', ['result'=>$result, $this->withFields($result), 'selectModelFields' => $this->selectModelFields()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->model
          ->findOrFail($id);

        // if (!empty($this->checkboxExplode)) {
        //     $requestData = $this->loadCheckboxExplode($result);
        // }

        return view($this->path.'.edit', ['result'=>$result, 'withFields' => $this->withFields($result), 'selectModelFields' => $this->selectModelFields()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        if (!empty($this->checkboxExplode)) {
            $requestData = $this->saveCheckboxExplode($requestData);
        }

        if (!empty($this->fileName)) {
            $requestData = $this->eachFiles($requestData, $request);
        }

        if (!empty($this->numbersWithDecimal)) {
            $requestData = $this->formatRemoveDecimal($requestData);
        }

        $result->update($requestData);
        return redirect($this->redirectPath)->withInput();
    }

    public function eachFiles($requestData, $request)
    {
        foreach ($this->fileName as $value) {
            $fileName = $value;
            $fileNameString = (string) $value;

            if (isset($request->$fileName)) {
                $search = 'data:image';
                $str = $request->$value;

                if(preg_match("/{$search}/i", $str)) {
                    $requestData[$fileName] = $this->uploadFilesBase64($request, $fileName, $fileNameString);
                } else {
                    $requestData[$fileName] = $this->uploadFiles($request, $fileName, $fileNameString);
                }
            }
        }

        return $requestData;
    }

    public function uploadFilesBase64($request, $fileName, $fileNameString)
    {
        $caminho = $this->uploadFilePath;

        $folderPath = $caminho;

        $image_parts = explode(";base64,", $request->$fileNameString);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.'.$image_type;
        $file = $folderPath . '/' . $fileName;

        file_put_contents($file, $image_base64);

        return $file;
    }

    public function uploadFiles($request, $fileName, $fileNameString)
    {
        $caminhoAbs =  $this->uploadFilePath;
        $nameFile = null;
        if ($request->hasFile($fileNameString) && $request->file($fileNameString)->isValid()) {
            $name = uniqid(date('HisYmd'));

            $extension = $request->$fileName->extension();

            $nameFile = "{$name}.{$extension}";

            $upload = $request->$fileName->move($caminhoAbs, $nameFile);

            return $caminhoAbs . '/' . $nameFile;
        } else {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->model->findOrFail($id);
        $result->delete();

        return json_encode(true);
    }

    /**
     * rota customizada da index
     *
     * @return \Illuminate\Http\Response
     */
    public function customIndex(Request $request)
    {
        dd('custom index');
    }

    /**
     * rota customizada da create
     *
     * @return \Illuminate\Http\Response
     */
    public function customCreate(Request $request)
    {
        dd('custom create');
    }


    /**
     * rota customizada da show
     *
     * @return \Illuminate\Http\Response
     */
    public function customShow($id)
    {
        dd('custom show' . $id);
    }

    public function saveCheckboxExplode($requestData)
    {
        foreach ($this->checkboxExplode as $key => $value) {
            foreach ($requestData as $k => $val) {
                if ($k == $value)
                    $requestData[$value] = (implode(",", $val));
            }
        }

        return $requestData;
    }

    public function loadCheckboxExplode($result)
    {
        foreach ($this->checkboxExplode as $key => $value) {
            foreach ($result->getAttributes() as $k => $val) {
                if ($k == $value)
                    $result[$value] = explode(",", $val);
            }
        }

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $result = $this->model->findOrFail($id);
        $result->status = $result->status == 1 ? 0 : 1;

        $result->save();

        return $id;
    }

    protected function relationships()
    {
        if (isset($this->relationships)) {
            return $this->relationships;
        }
        return [];
    }

    protected function withFields($result)
    {
        if (!empty($this->withFields)) {
            foreach ($this->withFields as $key => $value) {
                $withFields[$value] = $result->$value()->where('status', 1)->first();
            }

            return $withFields;
        }
        return [];
    }

    protected function selectModelFields()
    {
        if (!empty($this->selectModelFields)) {
            foreach ($this->selectModelFields as $key => $value) {
                $selectModelFields[$key] = $value::where('status', 1)->get();
            }
            return $selectModelFields;
        }
        return [];
    }

    public function where($where, $result)
    {
        $where = explode(',', $where);
        foreach (array_chunk($where, 3) as $key => $value) {
            $result = $result->where($value[0], $value[1], $value[2]);
        }

        return $result;
    }

    public function orWhere($orWhere, $result)
    {
        $orWhere = explode(',', $orWhere);
        foreach (array_chunk($orWhere, 3) as $key => $value) {
            $result = $result->orWhere($value[0], $value[1], $value[2]);
        }

        return $result;
    }

    public function with($with, $result)
    {
        $with = explode(',', $with);
        foreach ($with as $key => $value) {
            $result = $result->with($value);
        }

        return $result;
    }

    public function like($like, $result)
    {
        $like = explode(',', $like);

        foreach (array_chunk($like, 3) as $key => $value) {
            $result = $result->orWhere($value[0], 'LIKE', $value[2]);
        }

        return $result;
    }

    public function order($order, $result)
    {
        $order = explode(',', $order);
        $order[1] = $order[1] ?? 'asc';

        $result = $result->orderBy($order[0], $order[1]);

        return $result;
    }

    public function join($join, $result)
    {
        $join = explode(',', $join);

        foreach (array_chunk($join, 3) as $key => $value) {
            $result = $result->join($value[0], $value[1], $value[2]);
        }

        return $result;
    }

    public function leftJoin($join, $result)
    {
        $join = explode(',', $join);

        foreach (array_chunk($join, 3) as $key => $value) {
            $result = $result->leftJoin($value[0], $value[1], $value[2]);
        }

        return $result;
    }

    public function rightJoin($join, $result)
    {
        $join = explode(',', $join);

        foreach (array_chunk($join, 3) as $key => $value) {
            $result = $result->rightJoin($value[0], $value[1], $value[2]);
        }

        return $result;
    }

    public function select($select, $result)
    {
        return $result->selectRaw($select);
    }

    public function groupBy($group, $result)
    {
        return $result->groupByRaw($group);
    }

    public function search($search, $result){
        if ($search == 'ativo' OR $search == 'Ativo')
            return $result->orWhere('status', 'LIKE', 1);

        if ($search == 'bloqueado' OR $search == 'Bloqueado')
            return $result->orWhere('status', 'LIKE', 0);

        foreach ($result->getModel()->getFillable() as $key => $value) {
            $result = $result->orWhere($value, 'LIKE', "%$search%");
        }

        if (!empty($this->joinSearch)) {
            foreach ($this->joinSearch as $key => $value) {
                $searchJoin = $value[1]::select('id')->where($value[0], 'LIKE', "%$search%")->first()['id'] ?? null; //TODO: Se tiverem varias dados parecidos para filtrar, talvez precise alterar para um loop com limit 10
                if ($searchJoin)
                    $result = $result->orWhere($key, '=', $searchJoin);
            }

        }

        return $result;
    }
}
