<?php

namespace App\Services;
use App\Services\TodoService;

use App\Repositories\TypeTodoRepository;

use App\Exceptions\TypeNotExistsException;
use App\Exceptions\TypeAlreadyExistsException;
use App\Exceptions\TypeAlreadyInUseException;


class TypeTodoService
{
    protected $repository;

    public function __construct()
    {
        $this->respository = new TypeTodoRepository();
    }

    public function getAll()
    {
        return $this->respository->getAll();
    }

    public function create(array $data)
    {
        if($this->exists($data['description'])){
            throw new TypeAlreadyExistsException('Tipo de tarefa já existe.');
        }
        return $this->respository->create($data);
    }

    public function get(int $id)
    {
        return $this->respository->get($id);
    }

    public function update(array $data, int $id)
    {
        $typesByDescriptions = $this->getByDescription($array['description']);
        if(isset($typesByDescriptions[0]) && $typesByDescriptions[0]->id != $id){
            throw new TypeAlreadyExistsException('Tipo de tarefa já existe.');
        }
        return $this->respository->update($data, $id);
    }

    public function delete(int $id)
    {
        if($this->get($id) == null){
            throw new TypeNotExistsException('Tipo não existe.');
        }
        if((new TodoService)->existsTodoByType($id)){
            throw new TypeAlreadyInUseException('Não é possível deletar um Tipo em uso.');
        }

        return $this->respository->delete($id);
    }

    public function getByDescription(string $description)
    {
        return $this->respository->getByDescription($description);
    }

    public function exists(string $description)
    {
        return count($this->respository->getByDescription($description)) > 0;
    }

}
