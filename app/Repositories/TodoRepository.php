<?php 

namespace App\Repositories;

use App\Models\Todo;
use App\Models\User;
use App\Repositories\Interfaces\TodoRepositoryInterface;

class TodoRepository implements TodoRepositoryInterface
{
    public function getTodos(User $user)
    {
        return $user->todos;
    }

    public function getTodo(User $user,int $id)
    {
        return $user->todos()->findOrFail($id);
    }

    public function createTodo(User $user,array $data)
    {
        return $user->todos()->create($data)->refresh();
    }

    public function updateTodo(Todo $todo, array $data)
    {
        return $todo->update($data);
    }

    public function deleteTodo(Todo $todo)
    {
        return $todo->delete();
    }

    public function query(User $user)
    {
        return $user->todos()->query();
    }

    public function markAsCompletedOrNot(Todo $todo): bool
    {
        $todo->completed = !$todo->completed;
        return $todo->save();
    }
}