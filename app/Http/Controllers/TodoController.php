<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreUpdateTodo;
use App\Http\Resources\TodoResource;
use App\Services\TodoService;


use App\Models\Todo;
use App\Models\TypeTodo;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->todoService = new TodoService();
    }

    public function index(Request $request): JsonResponse
    {
        $type = $this->todoService->getAll();
        return response()->json($type);
    }

    public function get(Request $request,int $id): JsonResponse
    {
        $type = $this->todoService->get($id);
        return response()->json($type);
    }

    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'type_id' => 'required',
        ]);


        $request['user_id']=auth()->user()->getAuthIdentifier();

        $type = $this->todoService->create($request->all());


        return response()->json($type, JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request,int $id): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'type_id' => 'required',
        ]);

        $this->todoService->update($request->all(), $id);
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }

    public function delete(int $id): JsonResponse
    {
        $this->todoService->delete($id);
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }

}
