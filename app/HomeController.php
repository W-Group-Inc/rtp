<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeController extends Model
{
    //
    public function index()
    {
        return view('welcome');
    }
}
