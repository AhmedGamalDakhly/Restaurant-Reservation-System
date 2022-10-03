<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Ushow admin panel home page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(){
        return view('admin.index');
    }
}
