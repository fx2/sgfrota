<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ApiControllerTrait
{
    /**
     * Display a listing of the resource.
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

        if(isset($request->all()['whereYear'])) {
            $result = $this->whereYear($request->all()['whereYear'], $result);
        }

        if(isset($request->all()['orWhere'])) {
            $result = $this->orWhere($request->all()['orWhere'], $result);
        }
        
        if(isset($request->all()['get'])) {
            return response()->json($result->get());
        }
        $result = $result->paginate($limit);

        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->model->create($request->all());
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $result = $this->model;
        $result = $result->with($this->relationships());
        
        if (isset($request->all()['select'])) {
            $result = $this->select($request->all()['select'], $result);
        }
        
        if(isset($request->all()['with'])) {
            $result = $this->with($request->all()['with'], $result);
        }

        $result = $result->findOrFail($id);
        
        return response()->json($result);
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
        $result = $this->model->findOrFail($id);
        $result->update($request->all());
        return response()->json($result);
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
        return response()->json($result);
    }

    protected function relationships()
    {
        if (isset($this->relationships)) {
            return $this->relationships;
        }
        return [];
    }

    public function whereYear($where, $result)
    {
        $where = explode(',', $where);
        foreach (array_chunk($where, 3) as $key => $value) {
            $result = $result->whereYear($value[0], $value[1]);
        }

        return $result;
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
        $like[1] = '%' . $like[1] . '%';

        $result = $result->where(function($query) use ($like) {
            return $query->where($like[0], 'like', $like[1]);
        });

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
}