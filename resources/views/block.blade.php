<x-app-layout>
    <div class="container">
        <div class="block rounded space-between">
            <div class="row w-100 justify-center">
                @foreach($block as $blocks)
                    <h2 class="justify-center">{{ $blocks->title }}</h2>
                @endforeach
            </div>
        </div>
        @foreach($popups as $popup)
            <div class="block rounded space-between">
                <div class="row w-100">
                    <h2 class="w-20">{{ $popup->title }}</h2>
                    <p class="w-15">{{ $popup->subtitle }}</p>
                </div>
                <div class="row gap-1">
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
</x-app-layout>
