<?php

namespace App\Repositories;

use App\Models\TypeTodo;

class TypeTodoRepository
{

    protected $entity;

    public function __construct()
    {

        // $this->entity = $type;
        $this->entity = new TypeTodo;
    }

    public function getAll()
    {
        return $this->entity->all();
    }

    public function get(int $id)
    {
        return $this->entity->find($id);
    }
    public function getByDescription(string $description)
    {
        return $this->entity->where('description', $description)->get();
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
