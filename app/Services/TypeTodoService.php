<?php

namespace App\Services;

use App\Repositories\TypeTodoRepository;

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

    public function getByDescription(string $description)
    {
        return $this->respository->getByDescription($description);
    }
    
    public function exists(string $description)
    {
        return count($this->respository->getByDescription($description)) > 0;
    }

}