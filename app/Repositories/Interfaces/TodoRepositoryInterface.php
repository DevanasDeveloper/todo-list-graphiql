<?php

namespace App\Repositories\Interfaces;

use App\Models\Todo;
use App\Models\User;

interface TodoRepositoryInterface
{
    // get todos
    public function getTodos(User $user);
    // get todo by id
    public function getTodo(User $user, int $id);
    // create todo
    public function createTodo(User $user, array $data);
    // update todo
    public function updateTodo(Todo $todo ,array $data);
    // delete todo
    public function deleteTodo(Todo $todo);
    // mark todo as completed or not
    public function markAsCompletedOrNot(Todo $todo);
    // query
    public function query(User $user);
}