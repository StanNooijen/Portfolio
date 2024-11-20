@extends('layouts.master')
@section('content')
<body class="font-sans antialiased">

<div class="container " id="about">
    <div class="line-down"></div>
    <div class="row">
        <div class="shadow-bottom">
            <img src="{{asset('images/GoedeFotoStan.png')}}" alt="" style="height: 100%">
        </div>
        <div class="intro w-40">
            <h1 class="title poppins-bold">Stan Nooijen</h1>
            <div class="textBox">
                {{--                {{__('messages.about')}}--}}
                Ik ben een front-end developer die zijn passie voor webontwikkeling ontdekte tijdens mijn studie
                Software Development aan het SintLucas. Sinds mijn afstuderen heb ik gewerkt met Laravel, Vue en
                WordPress. Ik focus me op het maken van mooie en gebruiksvriendelijke UI- en UX-designs, altijd met oog
                voor detail en een optimale gebruikerservaring.
            </div>
            <div class="justify-end">
                <button id="meerOverMijButton" class="meerOverMijButton button poppins-regular">Meer over mij...
                </button>
            </div>
        </div>
    </div>
</div>
<div class="container" id="skills">
    {{--    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1640 200" width="1640" height="300">--}}
    {{--        <path d="M 0 300 Q 0 150 100 150 L 460 150 Q 520 150 520 0 Q 520 150 580 150 L 700 150 Q 820 150 820 300 "--}}
    {{--              fill="none" stroke="white" stroke-width="2"/>--}}
    {{--    </svg>--}}
    <div class="col gap-5 w-100 align-center">
        <div class="col w-90" style="gap: 20px">
            <div class="row gap-3" id="ball1">
                @foreach($hardskills as $index => $ball)
                    <button class="ball {{ $index === 0 ? 'active' : ''}}"
                            onclick="changeSkill({{ $index }}, 'skills1', 'ball1')"
                            style='background-image: url({{asset("images/hardSkills/" . $ball->BallImage . ".png")}})'></button>
                @endforeach
            </div>
            <div class="row skills" id="skills1">
                @foreach($hardskills as $index => $ball)
                    <div class="skill {{ $index === 0 ? 'active' : '' }}">
                        <div class="space-between">
                            <h2>{{ $ball->title }}</h2>
                        </div>
                        <p class="w-85">
                            {{ $ball->text }}
                        </p>
                    </div>
                @endforeach
            </div>
            <h1 class="poppins-bold text-end subtitle" id="hardSkill">Hard skills</h1>
        </div>
        <div class="col w-90 justify-start" style="gap: 20px">
            <h1 class="poppins-bold subtitle" id="softSkill">Soft skills</h1>
            <div class="row skills" id="skills2">
                @foreach($softskills as $index => $ball)
                    <div class="skill {{ $index === 0 ? 'active' : '' }}">
                        <div class="space-between">
                            <h2>{{ $ball->title }}</h2>
                        </div>
                        <p class="w-85">
                            {{ $ball->text }}
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="row gap-3" id="ball2">
                @foreach($softskills as $index => $ball)
                    <button class="ball {{ $index === 0 ? 'active' : ''}}"
                            onclick="changeSkill({{ $index }}, 'skills2', 'ball2')"
                            style='background-image: url({{asset("images/softSkills/" . $ball->BallImage . ".png")}})'></button>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container" id="projecten">
    <div class="projecten justify-center">
        <div class="projectenPositie">
            @foreach($projectenRijEen as $index => $projecten)
                @php
                    $afbeelding = $projecten->image ?? 'Rectangle.png';
                @endphp
                <x-projecten
                        :title="$projecten->Title"
                        :languages="$projecten->Programming_languages"
                        :description="$projecten->text"
                        :image="$afbeelding">
                </x-projecten>
            @endforeach
        </div>
        <div class="projectBallen" id="blobs">
            @for ($i = 0; $i < 11; $i++)
                <button class="blob {{ $i == 0 ? 'active' : '' }}"
                        onclick="changeProjecten({{ $i }}, 'projecten', 'blobs')"></button>
            @endfor
        </div>
        <div class="projectenPositie">
            @foreach($projectenRijTwee as $index => $projecten)
                @php
                    $afbeelding = $projecten->Image ?? 'Rectangle.png';
                @endphp
                <x-projecten
                        :title="$projecten->Title"
                        :languages="$projecten->Talen"
                        :description="$projecten->Content"
                        :image="$afbeelding">
                </x-projecten>
            @endforeach
        </div>
    </div>
</div>
</body>
@endsection
