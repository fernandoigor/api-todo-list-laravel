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
        return $this->entity->find($id);
        // return $this->entity->findOrFail($id);
    }

    public function getAllFromUser(int $userId)
    {
        return $this->entity->where('user_id', $userId)->get();
    }

    public function getByTitle(string $title, int $userId)
    {
        return $this->entity->where('title', $title)->where('user_id', $userId)->get();
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


    public function getByType(int $type)
    {
        return $this->entity->where('type_id', $type);
    }


}
