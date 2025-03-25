@props([
    'bannerHeight' => 'h-[25vh]',
    'backgroundImage' => asset('storage/breadcrumb.jpg')
])

<section class="relative bg-cover bg-center {{ $bannerHeight }}" style="background-image: url('{{ $backgroundImage }}');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div> <!-- Overlay -->
    <div class="relative flex flex-col justify-center items-center text-center text-white max-w-3xl mx-auto h-full px-6">
        {{ $slot }}
    </div>
</section>
