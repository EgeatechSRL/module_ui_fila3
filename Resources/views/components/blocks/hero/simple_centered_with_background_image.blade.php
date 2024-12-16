@props(['title', 'text', 'background'])

<div style="background-image: url('/storage/{{ $background }}'); height: calc(100vh - 2.8rem);">
    <div class="mx-auto max-w-2xl py-20 sm:py-24 lg:py-32">
        <div class="text-center flex flex-col gap-8">
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-4xl">{{ $title }}</h1>
            <div class="mt-10 flex items-center  justify-center gap-x-12">
                @foreach ($buttons as $btn)
                    <a href="{{ $btn['link'] }}" class="{{ $btn['class'] }}">{{ $btn['label'] }}</a>
                @endforeach
            </div>
            @php
                $text = str_replace('<p>', '<p class="mt-6 leading-normal text-white">', $text);
            @endphp
            {!! $text !!}
        </div>
    </div>
</div>
