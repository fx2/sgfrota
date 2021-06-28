<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class TaskController extends Controller
{
    use CrudControllerTrait;

    private $model;
    private $path;

    public function __construct(Task $task){
        $this->model = $task;
        $this->path = 'task';
    }
}
