@props(['note' => null, 'action'])

<div class="max-w-2xl p-6 mx-auto mt-10 bg-white border border-gray-300 rounded-lg shadow-md">
    <form action="{{ $action }}" method="POST">
        @csrf
        @isset($note)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700"> Título </label>

            <input type="text" id="title" placeholder="Escreva um título aqui..."
                class="w-full mt-1 border-gray-200 rounded-md shadow-sm sm:text-sm" name="title"
                value="{{ old('title', $note->title ?? '') }}" />
        </div>

        {{-- <div class="mb-4">
            <label for="title" class="block mb-2 font-semibold text-gray-700">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $note->title ?? '') }}"
                class="w-full p-2 border border-gray-300 rounded-lg" required>
        </div> --}}

        <div class="mb-4">
            <label for="body" class="block text-sm font-medium text-gray-700"> Conteúdo </label>

            <textarea id="body" rows="6" name="body"
                class="w-full mt-2 overflow-auto align-top border-gray-200 rounded-lg shadow-sm sm:text-sm max-h-96" rows="4"
                placeholder="Faça uma anotação aqui..." required>{{ old('body', $note->body ?? '') }}</textarea>
        </div>

        {{-- <div class="mb-4">
            <label for="body" class="block mb-2 font-semibold text-gray-700">Body</label>
            <textarea id="body" name="body" rows="6"
                class="w-full p-2 overflow-auto border border-gray-300 rounded-lg max-h-96" required>{{ old('body', $note->body ?? '') }}</textarea>
        </div> --}}

        <div class="mb-4">
            <label for="visibility" class="block text-sm font-medium text-gray-900"> Visibilidade </label>

            <select name="visibility" id="visibility"
                class="mt-1.5 w-full rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                <option value="public" {{ old('visibility', $note->visibility ?? '') == 'public' ? 'selected' : '' }}>
                    Público
                </option>
                <option value="private" {{ old('visibility', $note->visibility ?? '') == 'private' ? 'selected' : '' }}>
                    Privado
                </option>
            </select>
        </div>

        {{-- <div class="mb-4">
            <label for="visibility" class="block mb-2 font-semibold text-gray-700">Visibility</label>
            <select id="visibility" name="visibility" class="w-full p-2 border border-gray-300 rounded-lg" required>
                <option value="public" {{ old('visibility', $note->visibility ?? '') == 'public' ? 'selected' : '' }}>
                    Public
                </option>
                <option value="private" {{ old('visibility', $note->visibility ?? '') == 'private' ? 'selected' : '' }}>
                    Private
                </option>
            </select>
        </div> --}}

        <div class="flex justify-end">
            <button
                class="inline-block px-12 py-3 text-sm font-medium text-indigo-600 border border-indigo-600 rounded hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring active:bg-indigo-500"
                type="submit">
                {{ $note ? 'Editar Nota' : 'Salvar' }}
            </button>

            {{-- <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg">
                {{ $note ? 'Update Note' : 'Create Note' }}
            </button> --}}
        </div>
    </form>
</div>
