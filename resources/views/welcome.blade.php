<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=Luckiest+Guy&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Laravel</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/Main.sass'])
    @else
    @endif
</head>
<body class="font-sans antialiased">
<div class="navigation">
    <div class="navigator">
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="nav-links">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </div>
</div>
<div class="container ">
    <div class="row">
        <div class="shadow-bottom">
            <img src="{{asset('images/GoedeFotoStan.png')}}" alt="" style="height: 100%">
        </div>
        <div class="intro w-40">
            <h1 class="title poppins-bold">Stan Nooijen</h1>
            <div class="textBox">
                Ik ben een front-end developer die zijn passie voor webontwikkeling ontdekte tijdens mijn studie
                Software Development aan het SintLucas. Sinds mijn afstuderen heb ik gewerkt met Laravel, Vue en
                WordPress. Ik focus me op het maken van mooie en gebruiksvriendelijke UI- en UX-designs, altijd met oog
                voor detail en een optimale gebruikerservaring.
            </div>
            <div class="justify-end">
                <button id="meerOverMijButton" class="button poppins-regular">Meer over mij...</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col gap-5 w-100 align-center">
        <div class="col w-90" style="gap: 20px">
            <div class="row gap-3" id="ball1">
                @foreach($hardskills as $index => $ball)
                    <button class="ball {{ $index === 0 ? 'active' : ''}}" onclick="changeSkill({{ $index }}, 'skills1', 'ball1')"
                            style='background-image: url({{asset("images/hardSkills/" . $ball->BallImage . ".png")}})'></button>
                @endforeach
            </div>
            <div class="row skills" id="skills1">
                @foreach($hardskills as $index => $ball)
                    <div class="skill {{ $index === 0 ? 'active' : '' }}">
                        <div class="space-between">
                            <h1>{{ $ball->Title }}</h1>
                        </div>
                        <p class="w-85">
                            {{ $ball->Content }}
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
                    <div  class="skill {{ $index === 0 ? 'active' : '' }}">
                        <div class="space-between">
                            <h1>{{ $ball->Title }}</h1>
                        </div>
                        <p class="w-85">
                            {{ $ball->Content }}
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="row gap-3" id="ball2">
                @foreach($softskills as $index => $ball)
                    <button class="ball {{ $index === 0 ? 'active' : ''}}" onclick="changeSkill({{ $index }}, 'skills2', 'ball2')"
                            style='background-image: url({{asset("images/softSkills/" . $ball->BallImage . ".png")}})'></button>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container">

</div>

<div class="meerOverMij">
    <div class="row">
        <div class="col">
            <h1>Meer over mij</h1>
        </div>
        <div class="col">
            <div class="kruis"></div>
        </div>
    </div>
</div>
</body>
</html>
