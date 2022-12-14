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
        // auth()->user())->getAuthIdentifier();
        
        $type = $this->todoService->getAll();
        return response()->json($type);
        // dd(auth()->user()->getAuthIdentifier());
    }

    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'type_id' => 'required',
        ]);


        
        if(!TypeTodo::find($request->type_id)){
            return response()->json(["message"=>"Type todo not exists"], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
        }
        if($this->todoService->exists($request->title)){
            return response()->json(["message"=>"Already exists"], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
        }

        $request['user_id']=auth()->user()->getAuthIdentifier();

        $type = $this->todoService->create($request->all());


        return response()->json($type, JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request,int $id): JsonResponse
    {
        $typesByTitle = $this->todoService->exists($request->title);
        if(isset($typesByTitle[0]) && $typesByTitle[0]->id != $id){
            return response()->json(["message"=>"Todo already exists"], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
        }

        $this->todoService->update($request->all(),$id);
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }

    public function delete(int $id): JsonResponse
    {
        $this->todoService->delete($id);
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
    
}
