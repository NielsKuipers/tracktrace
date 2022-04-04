<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $dir = 'asc';
        if (request()->query('order') == 'asc')
            $dir = 'desc';

        return view('business.index', [
            'customers' => User::where('role', 'customer')->filter(request(['search', 'sort', 'order']))->paginate(9),
            'dir' => $dir
        ]);
    }
}
