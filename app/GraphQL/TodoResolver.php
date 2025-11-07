<?php

namespace App\GraphQL;

use Illuminate\Support\Facades\Validator;

class TodoResolver
{
    // get all todos
    public function todos($root, array $arguments, $context)
    {
        $user = $context->user();

        return $user->todos()->get();
    }

    // get single todo
    public function todo($root, array $arguments, $context)
    {
        $user = $context->user();

        return $user->todos()->findOrFail($arguments['id']);
    }

    // create new todo
    public function create($root, array $arguments, $context)
    {
        try {
            $validator = Validator::make($arguments, [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]);

            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => 'The validation is failed',
                    'errors' => $validator->errors()->all(),
                ];
            }

            $user = $context->user();

            $todo = $user->todos()->create([
                'title' => $arguments['title'],
                'description' => $arguments['description'],
                'completed' => false,
            ]);

            return [
                'success' => true,
                'message' => 'Creating todo successful',
                'errors' => [],
                'todo' => $todo
            ];
        } catch (\Throwable $th) {
            throw new \Exception('Creating todo failed !, ' . $th->getMessage());
        }
    }

    // update todo
    public function update($root, array $arguments, $context)
    {
        try {
            $validator = Validator::make($arguments, [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
            ]);

            if ($validator->fails()) {
                return [
                    'success' => false,
                    'message' => 'The validation is failed',
                    'errors' => $validator->errors()->all(),
                ];
            }

            $user = $context->user();

            $todo = $user->todos()->findOrFail($arguments['id']);
            $todo->title = $arguments['title'];
            $todo->description = $arguments['description'];
            $todo->save();

            return [
                'success' => true,
                'message' => 'Updating todo successful',
                'errors' => [],
                'todo' => $todo
            ];
        } catch (\Throwable $th) {
            throw new \Exception('Updating todo failed !, ' . $th->getMessage());
        }
    }

    // delete todo
    public function delete($root, array $arguments, $context)
    {
        try {
            $user = $context->user();

            $user->todos()->findOrFail($arguments['id'])->delete();

            return [
                'success' => true,
                'message' => 'Deleting todo successful',
                'errors' => [],
            ];
        } catch (\Throwable $th) {
            throw new \Exception('Deleting todo failed !, ' . $th->getMessage());
        }
    }

    // mark todo as completed or not
    public function markAsCompletedOrNot($root, array $arguments, $context)
    {
        try {
            $user = $context->user();

            $todo = $user->todos()->findOrFail($arguments['id']);

            $todo->completed = !$todo->completed;
            $todo->save();

            return [
                'success' => true,
                'message' => 'Marking todo as completed or not successful',
                'errors' => [],
                'todo' => $todo
            ];
        } catch (\Throwable $th) {
            throw new \Exception('Marking todo as completed or not failed !, ' . $th->getMessage());
        }
    }
}