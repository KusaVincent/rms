<button
    type="submit"
    class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 flex items-center justify-center"
    wire:loading.attr="disabled">
    <x-ui.loader-spinner />
    <span wire:loading.class="hidden">Send Message</span>
</button>
