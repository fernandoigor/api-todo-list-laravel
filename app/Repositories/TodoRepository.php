<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository
{

    protected $entity;

    public function __construct()
    {
        $this->entity = new Todo;
    }

    public function getAll()
    {
        return $this->entity->all();
    }
    
    public function get(int $id)
    {
        return $this->entity->findOrFail($id);
    }
    public function getByTitle(string $title)
    {
        return $this->entity->where('title', $title)->get();
    }
    
    public function create(array $data)
    {
        return $this->entity->create($data);
    }
    
    public function update(array $data, int $id)
    {
        $type = $this->get($id);
        return $type->update($data);
    }
    
    public function delete(int $id)
    {
        $type = $this->get($id);
        return $type->delete();
    }

}