<x-app-layout>
    <div class="container gap-1">
        <div class="block justify-center">
            <div class="row w-100 justify-center">
                @foreach($block as $blocks)
                    <h1 class="justify-center">{{ $blocks->title }}</h1>
                @endforeach
            </div>
        </div>
        {!! $html !!}
        @if($block->first()->title != 'Skills')
            <button type="button" class="collapsible collapsible flex-row align-center space-between w-100">
                <h2>popups</h2>
                <svg height="30" width="30" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M5 7.5a1 1 0 011.5 0l3.5 3.5 3.5-3.5a1 1 0 011.5 0 1 1 0 010 1.5l-4 4a1 1 0 01-1.5 0l-4-4a1 1 0 010-1.5z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="content">
                @foreach($popups as $popup)
                    <div class="block flex-wrap rounded space-between">
                        <div class="flex-row gap-1">
                            <h4 class="w-fit-content">{{ $popup->title }}</h4>
                            <p class="w-fit-content align-center flex-wrap">{{ $popup->subtitle }}</p>
                        </div>
                        <div class="flex-row align-items-center gap-1">
                            <form>
                                @csrf
                                @method('PUT')
                                <x-primary-button>{{__('Edit')}}</x-primary-button>
                            </form>
                            <form>
                                @csrf
                                @method('DELETE')
                                <x-danger-button>{{__('Delete')}}</x-danger-button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
