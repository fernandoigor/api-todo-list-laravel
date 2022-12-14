<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Services\TypeTodoService;

class TypeTodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeTodo = new TypeTodoService();
        $typeTodo->create(["description"=>"Urgente"]);
        $typeTodo->create(["description"=>"Agendado"]);
        $typeTodo->create(["description"=>"Sem prioridade"]);
        // TypeTodoService::create(["description"=>"Urgente"]);
    }
}
