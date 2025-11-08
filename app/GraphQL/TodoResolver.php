<?php

namespace App\GraphQL;

use App\Services\TodoService;
use Illuminate\Support\Facades\Validator;

class TodoResolver
{
    public function __construct(
        protected TodoService $todoService
    ){}
    // get all todos
    public function todos($root, array $arguments, $context)
    {        
        return $this->todoService->getTodos($context->user());;
    }

    // get single todo
    public function todo($root, array $arguments, $context)
    {
        return $this->todoService->getTodo($context->user(), $arguments['id']);
    }

    // create new todo
    public function create($root, array $arguments, $context)
    {
        try {
            $todo = $this->todoService->createTodo($context->user(), $arguments);

            return [
                'success' => true,
                'message' => 'Creating todo successful',
                'errors' => [],
                'todo' => $todo
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Creating todo failed !, ' . $th->getMessage(),
                'errors' => [],
            ];
        }
    }

    // update todo
    public function update($root, array $arguments, $context)
    {
        try {
            $todo = $this->todoService->updateTodo($context->user(), $arguments);

            return [
                'success' => true,
                'message' => 'Updating todo successful',
                'errors' => [],
                'todo' => $todo
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Updating todo failed !, ' . $th->getMessage(),
                'errors' => []
            ];
        }
    }

    // delete todo
    public function delete($root, array $arguments, $context)
    {
        try {
            $this->todoService->deleteTodo($context->user(), $arguments['id']);

            return [
                'success' => true,
                'message' => 'Deleting todo successful',
                'errors' => [],
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Deleting todo failed !, ' . $th->getMessage(),
                'errors' => [],
            ];
        }
    }

    // mark todo as completed or not
    public function markAsCompletedOrNot($root, array $arguments, $context)
    {
        try {
            $todo = $this->todoService->markAsCompletedOrNot($context->user(), $arguments['id']);

            return [
                'success' => true,
                'message' => 'Marking todo as completed or not successful',
                'errors' => [],
                'todo' => $todo
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Marking todo as completed or not failed !, ' . $th->getMessage(),
                'errors' => []
            ];
        }
    }
}