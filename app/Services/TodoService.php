<?php

namespace App\Services;

use App\Repositories\TodoRepository;
use App\Models\TypeTodo;

use Illuminate\Http\JsonResponse;

use App\Exceptions\TodoAlreadyExistsException;
use App\Exceptions\TodoNotExistsException;
use App\Exceptions\TodoFromAnotherUserException;
use App\Exceptions\TypeNotExistsException;

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
            throw new TypeNotExistsException('Tipo de tarefa não encontrado.');
        }
        if($this->exists($data['title'])){
            throw new TodoAlreadyExistsException('Titulo da tarefa já existe para seu usuário.');
        }
        return $this->respository->create($data);
    }

    public function get(int $id)
    {
        $todo = $this->respository->get($id);
        if(!$todo){
            throw new TodoNotExistsException('Tarefa não existe.');
        }

        $userId = auth()->user()->getAuthIdentifier();
        if($todo->user_id != $userId){
            throw new TodoFromAnotherUserException('Tarefa de outro usuário.');
        }
        return $todo;
    }

    public function update(array $data, int $id)
    {
        $userId = auth()->user()->getAuthIdentifier();
        if(!$this->checkTodoUser($id, $userId)){
            throw new TodoFromAnotherUserException('Tarefa de outro usuário.');
        }

        $typesByTitle = $this->respository->getByTitle($data['title'],$userId);
        if(isset($typesByTitle[0]) && $typesByTitle[0]->id != $id){
            throw new TodoAlreadyExistsException('Titulo da tarefa já existe para seu usuário.');
        }
        return $this->respository->update($data, $id);
    }

    public function delete(int $id)
    {
        $userId = auth()->user()->getAuthIdentifier();
        if(!$this->checkTodoUser($id, $userId)){
            throw new TodoFromAnotherUserException('Tarefa de outro usuário.');
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

    public function existsTodoByType(int $typeId)
    {
        return $this->respository->getByType($typeId)->count() > 0;
    }

}
