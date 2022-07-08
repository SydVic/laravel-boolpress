<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\userDetails;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user();
        // se non ho capito male la relazione è con il model, quindi devi usare ->userDetails che è il nome del model
        $user_details = $user->userDetails;

        // si può fare anche il percorso contrario, prelevare User partendo da UserDetails
        // ti serve però l'id dello user che vuoi prelevare
        // $user_details = UserDetails::find(1);
        // $user = $user_details->user;
        // dd($user);

        return view('admin.home', compact('user', 'user_details'));
    }
}
