@props(['note'])

<div class="p-4 bg-white rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-8">
        <h2 class="mb-2 text-xl font-bold">{{ $note->title }}</h2>

        <div class="px-2.5 py-0.5 mt-2 mb-2 border rounded-full text-sm self-end">
            @if ($note->visibility === 'public')
                <i class="fas fa-eye" title="Public"></i>
                <span class="text-sm">Público</span>
            @else
                <i class="fas fa-lock" title="Private"></i>
                <span class="text-sm">Privado</span>
            @endif
        </div>
    </div>

    <div>
        <p class="mb-2 text-gray-700 whitespace-pre-wrap">{!! nl2br(e($note->body)) !!}</p>
    </div>

    <div class="flex items-end justify-between">
        <p class="mb-2 text-sm text-gray-500">Created by: {{ $note->user->name }}</p>

        @if (auth()->check() && auth()->id() == $note->user_id)
            <div class="flex mt-4 space-x-2">
                <form action="{{ route('notes.delete', $note) }}" method="POST"
                    onsubmit="return confirm('Tem certeza que deseja excluir esta nota?');">
                    @csrf
                    @method('DELETE')
                    <span class="inline-flex justify-end overflow-hidden bg-white border rounded-md shadow-sm">
                        <a class="inline-block p-3 text-gray-700 border-e hover:bg-gray-50 focus:relative"
                            title="Editar Nota" href="{{ route('notes.edit', $note) }}">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <button class="inline-block p-3 text-gray-700 border-e hover:bg-gray-50 focus:relative"
                            title="Excluir Nota">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                        {{-- @if ($note->visibility === 'private')
                            <div id="shareButton"
                                class="inline-block p-3 text-gray-700 cursor-pointer hover:bg-gray-50 focus:relative">
                                <i class="fa-regular fa-share-from-square"></i>
                            </div>
                        @endif --}}
                    </span>
                </form>
            </div>
        @endif
    </div>
</div>
