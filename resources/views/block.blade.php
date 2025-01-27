<x-app-layout>
    <div id="vertical-scroll" class="container vertical-scroll align-items-center p-1 justify-start bg-light-black w-100 rounded h-100">
        <div class="block rounded space-between w-100">
            @foreach($block as $blocks)
                <h2>{{ $blocks->title }}</h2>
                <form class="align-items-center" action="{{route('dashboard')}}">
                    @csrf
                    <x-primary-button>{{__('Terug')}}</x-primary-button>
                </form>
            @endforeach
        </div>
        {!! $html !!}
    </div>
</x-app-layout>
