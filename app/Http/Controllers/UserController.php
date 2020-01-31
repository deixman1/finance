<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function get() {
        return json_encode(Auth::user());
    }
    public function create() {

    }
    public function store() {

    }
    public function edit() {

    }
    public function update() {

    }
    public function destroy() {

    }
}
