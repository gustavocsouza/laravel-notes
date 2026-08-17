<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
  public function index()
  {
    // todo -> load users
    $userId = session('user.id');
    $notes = User::find($userId)
                ->notes()
                ->whereNull('deleted_at')
                ->get()
                ->toArray();

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

    $note = Note::find($id);

    return view('edit_note', ['note' => $note]);
  }

  public function editNoteSubmit(Request $request)
  {
    // validate request
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

    // check if note_id exists

    $note_id = $request->note_id;
    if ($note_id == null) {
      return redirect()->route('home');
    }

    // decrypt note_id
    $id = Operations::decryptId($note_id);

    // load note
    $note = Note::find($id);

    // update note
    $note->title = $request->text_title;
    $note->text = $request->text_note;

    $note->save();

    // redirect to home
    return redirect()->route('home');
  }

  public function deleteNote($id) 
  {
    $id = Operations::decryptId($id);

    // load note
    $note = Note::find($id);

    // show delete note confirm
    return view('delete_note', ['note' => $note]);    
  }

  public function deleteNoteConfirm($id) 
  {
    // check if $id is encrypted
    $id = Operations::decryptId($id);

    // load note
    $note = Note::find($id);

    // 1.hard delete
    // $note->delete();

    // 2.soft delete
    $note->deleted_at = date('Y:m:d H:i:s');
    $note->save();


    // redirect to home
    return redirect()->route('home');
    echo $id;
  }
}
