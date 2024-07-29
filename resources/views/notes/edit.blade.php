@extends('layouts.app')

@section('content')
    <div class="container p-4 mx-auto">
        <h1 class="mb-4 text-2xl font-bold">Edit Note</h1>
        <x-note-form :note="$note" :action="route('notes.update', $note)" />
    </div>
@endsection
