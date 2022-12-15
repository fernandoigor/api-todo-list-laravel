<?php

namespace App\Services;

use App\Repositories\TodoRepository;
use App\Models\TypeTodo;

use Illuminate\Http\JsonResponse;

use App\Exceptions\TokenInvalidException;

class TodoService
{
    protected $repository;

    public function __construct()
    {
        $this->respository = new TodoRepository();
    }

    public function getAll()
    {
        $userId = auth()->user()->getAuthIdentifier();
        return $this->respository->getAllFromUser($userId);
    }


    public function create(array $data)
    {
        if(!TypeTodo::find($data['type_id'])){
            dd("Type todo not exists");
        }
        if($this->exists($data['title'])){
            dd("Already exists");
        }
        return $this->respository->create($data);
    }

    public function get(int $id)
    {
        $todo = $this->respository->get($id);
        if(!$todo){
            dd('Todo not exists');
        }

        $userId = auth()->user()->getAuthIdentifier();
        if($todo->user_id != $userId){
            dd('Todo de outro usuario');
        }
        return $todo;
    }

    public function update(array $data, int $id)
    {
        $userId = auth()->user()->getAuthIdentifier();
        if(!$this->checkTodoUser($id, $userId)){
            dd("todo pertence ao outro usuario");
        }

        $typesByTitle = $this->respository->getByTitle($data['title'],$userId);
        if(isset($typesByTitle[0]) && $typesByTitle[0]->id != $id){
            dd("Todo already exists");
        }
        return $this->respository->update($data, $id);
    }

    public function delete(int $id)
    {
        $userId = auth()->user()->getAuthIdentifier();
        if(!$this->checkTodoUser($id, $userId)){
            dd("todo pertence ao outro usuario");
        }
        return $this->respository->delete($id);
    }

    public function exists(string $title)
    {
        $userId = auth()->user()->getAuthIdentifier();
        return count($this->respository->getByTitle($title,$userId)) > 0;
    }

    public function checkTodoUser(int $id, int $userId)
    {
        $type = $this->get($id);
        if($type != null && $type->user_id == $userId)
            return true;
        return false;
    }

}
