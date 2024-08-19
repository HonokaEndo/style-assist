<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary;

class HomeController extends Controller
{
   public function index()
    {
        return view('home.homeindex');
    } 
}
