<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTypeTodo;
use App\Http\Resources\TypeTodoResource;
use App\Services\TypeTodoService;

use App\Models\TypeTodo;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TypeTodoController extends Controller
{
    protected $typeService;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->typeService = new TypeTodoService();
    }

    public function index(Request $request): JsonResponse
    {
        $type = $this->typeService->getAll();
        return response()->json(TypeTodoResource::collection($type));
    }

    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        
        if($this->typeService->exists($request->description)){
            return response()->json(["message"=>"Already exists"], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
        }

        $type = $this->typeService->create($request->all());
        return response()->json(TypeTodoResource::collection([$type]), JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request,int $id): JsonResponse
    {
        $this->validate($request, [
            'description' => 'required'
        ]);

        $typesByDescriptions = $this->typeService->getByDescription($request->description);
        if(isset($typesByDescriptions[0]) && $typesByDescriptions[0]->id != $id){
            return response()->json(["message"=>"Already exists"], JsonResponse::HTTP_METHOD_NOT_ALLOWED);
        }

        $this->typeService->update($request->all(),$id);
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }

    public function delete(int $id): JsonResponse
    {
        $this->typeService->delete($id);
        return response()->json(null, JsonResponse::HTTP_NO_CONTENT);
    }
    
}
