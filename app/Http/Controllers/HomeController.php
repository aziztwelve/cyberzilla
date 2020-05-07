<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id  = auth()->user()->id;
        $user  = auth()->user();
        $todos = Todo::where('user_id', $user_id)->get();
//        dd($todos);
        return view('home',[
                'user' => $user,
                'todos' => $todos,
        ]);
    }

    public function getCurrentUser()
    {
        $user  = auth()->user();

        if (! $user) {
            return response()->json([
                'error' => "ошибка!"
            ], 400);
        }
        return response()->json(['user'=>$user], 200);

    }

    public function updateCurrentUser( Request $request)
    {

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'message' => 'Успешно обновлено!'
        ]);

    }
}
