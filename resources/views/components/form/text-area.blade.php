<div>
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
        Message
        <textarea
            name="message"
            wire:model="form.message"
            placeholder="Write message"
            class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            rows="5">
        </textarea>
    </label>
    @error('form.message')
    <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
