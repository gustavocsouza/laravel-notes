<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
  public function index()
  {
    // todo -> load users
    $userId = session('user.id');
    $notes = User::find($userId)->notes()->get()->toArray();

    // show home view
    return view('home', ['notes' => $notes]);
  }

  public function newNote()
  {
    echo 'New Note';
  }

  public function editNote($id) 
  {
    $id = Operations::decryptId($id);

    echo $id;
  }

  public function deleteNote($id) 
  {
    $id = Operations::decryptId($id);

    echo $id;
  }
}
