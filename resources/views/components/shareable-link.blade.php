<!-- resources/views/components/shareable-link.blade.php -->

@props(['link'])

<div class="relative inline-flex items-center">
    <input type="text" value="{{ $link }}"
        class="w-auto h-10 max-w-full p-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-l-lg" readonly
        oninput="adjustWidth(this)">
    <button id="shareButton"
        class="flex items-center h-10 px-4 py-2 text-gray-700 border border-gray-300 rounded-r-lg hover:bg-gray-50 focus:relative"
        onclick="copyToClipboard('{{ $link }}')">
        <i class="fa-regular fa-clipboard"></i>
    </button>
    <div id="tooltip"
        class="absolute right-0 hidden px-3 py-1 mb-2 text-sm text-white transform -translate-y-2 bg-black rounded-md bottom-full">
        Link copiado para o clipboard!
    </div>
</div>

<script>
    function copyToClipboard(link) {
        navigator.clipboard.writeText(link).then(function() {
            // Show tooltip
            const tooltip = document.getElementById('tooltip');
            tooltip.classList.remove('hidden');
            tooltip.classList.add('block');

            // Hide tooltip after 3 seconds
            setTimeout(function() {
                tooltip.classList.remove('block');
                tooltip.classList.add('hidden');
            }, 3000);
        }, function(err) {
            console.error('Erro ao copiar o link: ', err);
        });
    }

    function adjustWidth(el) {
        el.style.width = 'auto';
        el.style.width = (el.scrollWidth > 300 ? 300 : el.scrollWidth) + 'px';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector('input[type="text"][readonly]');
        adjustWidth(input);
    });
</script>
