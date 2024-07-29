<!-- resources/views/components/compact-note.blade.php -->

@props(['note'])

<div
    class="block p-4 mb-4 transition-transform duration-200 ease-in-out transform bg-white border border-gray-300 rounded-lg shadow-md hover:-translate-y-2 hover:shadow-lg">
    <div>

        <div class="flex items-center justify-between mb-2">
            <h2 class="mb-2 text-xl font-bold">{{ $note->title }}</h2>


            <div class="px-2.5 py-0.5 mt-2 mb-2 border rounded-full text-sm flex justify-between self-start">
                @if ($note->visibility === 'public')
                    <i class="self-center fas fa-eye" title="Public"></i>
                    <span class="mx-2 text-sm">Público</span>
                @else
                    <i class="self-center fas fa-lock" title="Private"></i>
                    <span class="mx-2 text-sm">Privado</span>
                @endif
            </div>



        </div>
        <div>
            <p class="mb-2 text-gray-700 whitespace-pre-wrap">{!! Str::limit(e($note->body), 200) !!}</p>
        </div>

        <div class="flex items-end justify-between">
            <p class="mb-2 text-sm text-gray-500">Criado por {{ $note->user->name }}</p>

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
                            <button class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative"
                                title="Excluir Nota">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </span>
                    </form>
                </div>
            @endif
        </div>

        <a href="{{ route('notes.show', $note) }}" class="text-blue-500 hover:underline">Ver mais <i
                class="fa-solid fa-arrow-right-long"></i></a>
    </div>
</div>
