<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tests = User::OrderBy('created_at', 'DESC');

        if (request()->has('search'))
        {
            $tests = $tests->where('name', 'ILIKE', '%' . request()->get('search', ''). '%');
        }

        return view('home', 
        [
            'tests' => $tests->paginate(10)
        ]);
    }
}
