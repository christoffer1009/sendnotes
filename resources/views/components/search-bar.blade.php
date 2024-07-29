@props(['action'])

<form action="{{ $action }}" method="GET" class="flex items-center mb-6">
    <div class="relative">
        <input type="text" id="search" placeholder="Pesquisar..." name="search"
            class="w-full rounded-md border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm" value="{{ request('search') }}" />

        <span class="absolute inset-y-0 grid w-10 end-0 place-content-center">
            <button class="text-gray-600 hover:text-gray-700" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </span>
    </div>
</form>
