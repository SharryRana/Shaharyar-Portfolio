<?php

namespace Modules\BlogAdmin\Http\Controllers\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function login()
    {

        return Inertia::render('Auth/login');
    }


}
