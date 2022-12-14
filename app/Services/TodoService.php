<?php

namespace App\Services;

use App\Repositories\TodoRepository;

class TodoService
{
    protected $repository;

    public function __construct()
    {
        $this->respository = new TodoRepository();
    }

    public function getAll()
    {
        return $this->respository->getAll();
    }
    

    public function create(array $data)
    {
        return $this->respository->create($data);
    }

    public function get(int $id)
    {
        return $this->respository->get($id);
    }

    public function update(array $data, int $id)
    {
        return $this->respository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->respository->delete($id);
    }
    
    public function exists(string $title)
    {
        return count($this->respository->getByTitle($title)) > 0;
    }

}