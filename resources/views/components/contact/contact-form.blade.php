<div class="w-full lg:w-7/12">
    <form wire:submit.prevent="submit" class="bg-white p-8 rounded-lg shadow-md">
        <!-- Success/Error Messages -->
        @if(session('message'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input name="name" type="text" value="{{ old('name') }}" placeholder="Name" wire:model="name">
                Name
            </x-form.input>
            <x-form.input name="email" type="email" value="{{ old('email') }}" placeholder="Email" wire:model="email">
                Email
            </x-form.input>
            <x-form.input name="subject" type="text" value="{{ old('subject') }}" placeholder="Subject" wire:model="subject">
                Subject
            </x-form.input>
            <x-form.input name="mobile" type="text" value="{{ old('mobile') }}" placeholder="Phone Number" wire:model="mobile">
                Phone Number
            </x-form.input>
        </div>

        <div class="mt-4">
            <textarea wire:model="message" placeholder="Write message" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" rows="5"></textarea>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600">
                Send Message
            </button>
        </div>
    </form>
</div>
