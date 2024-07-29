<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('visibility', 'public')->get();

        return view('notes.index', compact('notes'));
    }

    public function myNotes()
    {
        $notes = Note::where('user_id', auth()->user()->id)->get();
        return view('notes.myNotes', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'visibility' => 'required|in:public,private',
        ]);
        $accessToken = null;
        if ($request->visibility === 'private') {
            $accessToken = (string) Str::uuid();
            while (Note::where('access_token', $accessToken)->exists()) {
                $accessToken = (string) Str::uuid();
            }
        }

        Note::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'visibility' => $request->input('visibility'),
            'access_token' => $accessToken,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('notes.index');
    }

    public function show(Request $request, Note $note)
    {
        $user = $request->user();

        // Verifica se a nota é privada
        if ($note->visibility === 'private') {
            // Se o usuário estiver autenticado e for o dono da nota, permite acesso
            if ($user && $user->id === $note->user_id) {
                return view('notes.show', compact('note'));
            }

            // Verifica se um token de acesso válido foi fornecido
            $token = $request->query('token');

            if (!$token) {
                abort(403, 'Unauthorized action.');
            }

            if ($note->access_token === $token) {
                return view('notes.show', compact('note'));
            }

            // Se nenhuma das condições for satisfeita, negue o acesso
            abort(403, 'Unauthorized action.');
        }

        // Se a nota for pública, permite acesso
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        if ($note->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== auth()->user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'visibility' => 'required|in:public,private',
        ]);

        if ($request->visibility !== $note->visibility) {
            if ($request->visibility === 'private') {
                $access_token = (string) Str::uuid();
                while (Note::where('access_token', $access_token)->exists()) {
                    $access_token = (string) Str::uuid();
                }
            } elseif ($request->visibility === 'public') {
                $access_token = null;
            }
        }

        $note->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'visibility' => $request->input('visibility'),
            'access_token' => $access_token
        ]);


        return redirect()->route('notes.index');
    }

    public function destroy(Note $note)
    {
        if ($note->user_id !== auth()->user()->id) {
            abort(403);
        }
        $note->delete();

        return redirect()->route('notes.index');
    }
}
