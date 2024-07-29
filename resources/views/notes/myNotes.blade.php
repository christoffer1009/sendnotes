@extends('layouts.app')

@section('content')
    <div class="container p-4 mx-auto">
        <x-search-bar :action="route('notes.myNotes')" />
        <h1 class="mb-4 text-2xl font-bold">Minhas Notas</h1>
        @if ($notes->isEmpty())
            <p class="text-gray-600">Nenhuma nota encontrada.</p>
        @else
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($notes as $note)
                    <x-note-compact :note="$note" />
                @endforeach
            </div>
        @endif
    </div>
    <div class="mt-6">
        {{ $notes->links() }}
    </div>
@endsection
