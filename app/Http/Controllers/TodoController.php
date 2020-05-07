<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $user_id  = auth()->user()->id;
        $todo = Todo::where('user_id', $user_id)->take(10)->get();

        if (! $todo) {
            return response()->json([
                'error' => "ошибка!"
            ], 400);
        }
        return response()->json(['todo'=>$todo], 200);
    }

    public function update($id, Request $request)
    {
        $user_id  = auth()->user()->id;

        $todo = Todo::where('id', $id)
            ->where('user_id', $user_id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
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

    public function destroy($id)
    {
        $user_id  = auth()->user()->id;
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


    public function getTodo($id)
    {
        $user_id  = auth()->user()->id;
        $todo = Todo::where('user_id', $user_id)->where('id', $id)->get();

        if (! $todo) {
            return response()->json([
                'error' => "ошибка!"
            ], 400);
        }
        return response()->json(['todo'=>$todo], 200);
    }


}
