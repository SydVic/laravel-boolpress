<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        // se non ho capito male la relazione è con il model, quindi devi usare ->UserDetails che è il nome del model
        $user_details = $user->UserDetails;
        return view('admin.home', compact('user', 'user_details'));
    }
}
