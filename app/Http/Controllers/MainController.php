<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
   public function index() 
   {
     // todo -> load users
     $userId = session('user.id');
     $user = User::find($userId)->toArray();
     $notes = User::find($userId)->notes()->get()->toArray();

     echo '<pre>';
     print_r($user);
     print_r($notes);

     die();
     // show home view
     return view('home');
   }

   public function newNote() 
   {
        echo 'New Note';
   }
}
