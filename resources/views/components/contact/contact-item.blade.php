<li class="flex items-center">
    <i class="fa{{ $icon === 'whatsapp' ? 'b ' : ' ' }}fa-{{ $icon }} text-blue-500 mr-4"></i>
    <div>
        <p class="font-semibold">{{ $label }}</p>
        <a href="{{ $link }}" class="text-blue-500 hover:underline">{{ $linkText }}</a>
    </div>
</li>
