<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            return 'rolepage';
    }
    public function create()
    {
        return 'create';
    }
}
