@props(['title', 'text', 'background'])

<div style="height: calc(100vh - 2.99rem);">
    <div class="video-container">
        <video autoplay muted loop>
            <source src="/storage/{{ $background }}" type="video/mp4">
            <img src="/storage/blocks/home-bg2.png"/>
        </video>
    </div>
    <div class="ml-16 max-w-4xl title-box-padding">
        <div class="text-left flex flex-col gap-8">
            <h1 class="text-4xl font-semibold tracking-tight text-white sm:text-4xl">{{ $title }}</h1>
            @php
                $text = str_replace('<p>', '<p class="mt-6 leading-7 text-white">', $text);
            @endphp
            {!! $text !!}
            <div class="mt-10 flex items-center  justify-start gap-x-12">
                @foreach ($buttons as $btn)
                    <a href="{{ $btn['link'] }}" class="{{ $btn['class'] }}" style="{{$btn['style']}}">{{ $btn['label'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
    <style>
        .video-container video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -10;
        }
        .title-box-padding {
            padding-top: 10%;
        }
        .bg-red-600:hover {
            background-color: #EA5545;
            transition: 250ms;
        }
        .bg-amber-600 {
            background-color: #F59E0B;
        }
        .bg-amber-600:hover {
            background-color: #E8A73D;
            transition: 250ms;
        }
    </style>
</div>
