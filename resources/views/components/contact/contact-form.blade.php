<div class="w-full lg:w-7/12">
    <form wire:submit.prevent="save" class="bg-white p-8 rounded-lg shadow-md">
        <x-form.success-message />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.form-field
                name="name"
                placeholder="Name"
            />

            <x-form.form-field
                name="email"
                placeholder="Email"
            />

            <x-form.form-field
                name="subject"
                placeholder="Subject"
            />

            <x-form.form-field
                name="phone_number"
                placeholder="Phone Number"
            />
        </div>

        <div class="mt-4">
            <x-form.text-area />
        </div>

        <div class="mt-4">
            <x-form.form-button />
        </div>
    </form>
</div>
