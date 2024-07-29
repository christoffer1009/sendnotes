@extends('layouts.app')

@section('content')
    <div class="container p-4 mx-auto ">
        <x-note :note="$note" />

        @if ($note->visibility === 'private' && (Auth::check() && Auth::user()->id === $note->user_id))
            <div class="mt-4">
                <p class="block mb-2 ml-1 text-sm font-medium text-gray-700">Shareable Link:</p>
                <x-shareable-link :link="route('notes.show', ['note' => $note, 'token' => $note->access_token])" />
            </div>
        @endif
    </div>
@endsection
