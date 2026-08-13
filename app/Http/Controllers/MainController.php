<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
    return view('new_note');
  }

  public function newNoteSubmit(Request $request)
  {
    $request->validate(
        [
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:3000',
        ],
        [
            'text_title.required' => 'O título é obrigatório.',
            'text_title.min' => 'O titulo deve ter no mínimo :min caracteres',
            'text_title.max' => 'O titulo deve ter no máximo :max carateres',
            'text_note.required' => 'A nota é obrigatório.',
            'text_note.min' => 'A nota deve ter no mínimo :min caracteres',
            'text_note.max' => 'A nota deve ter no máximo :max carateres',
        ]
    );  

    $id = session('user.id');

    $note = new Note();
    $note->user_id = $id;
    $note->title = $request->text_title;
    $note->text = $request->text_note;
    $note->save();

    return redirect()->route('home');
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
