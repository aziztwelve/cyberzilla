<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Todo;
use App\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index($user_id)
    {
        $user = User::find($user_id)->id;
        return Todo::where('user_id', (int)$user)->get();
    }

    public function store($user_id, Request $request)
    {
        $todo = Todo::create([
           'title' => $request->title,
           'content' => $request->content,
           'user_id' => (int)$user_id,
        ]);
        if (! $todo) {
            return response()->json([
                'error' => "ошибка!"
            ], 400);
        }
        return response()->json([
            'message' => 'Успешно добавлено!'
        ]);

    }


    public function show($user_id, $id)
    {
        $todo = Todo::where('id', $id)
                        ->where('user_id', $user_id)
                        ->get();

        return response()->json($todo);

    }

    public function update($user_id, $id, Request $request)
    {

        $todo = Todo::where('id', $id)
            ->where('user_id', $user_id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => (int)$user_id,
            ]);

        if (! $todo) {
            return response()->json([
                'error' => "ошибка!"
            ], 400);
        }
        return response()->json([
            'message' => 'Успешно обновлено!'
        ]);
    }

    public function destroy($user_id, $id)
    {
        $todo = Todo::where('id', $id)
            ->where('user_id', $user_id)
            ->delete();

        if (! $todo) {
            return response()->json([
                'error' => "ошибка!"
            ], 400);
        }
        return response()->json([
            'message' => 'Успешно удалено!'
        ]);
    }
}
