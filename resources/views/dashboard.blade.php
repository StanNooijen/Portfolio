<x-app-layout>
    <div class="container">
        @foreach($blocks as $block)
            <div class="block rounded space-between">
                <div class="row w-100">
                    <h2 class="w-15">{{ $block->type }}</h2>
                    <p class="w-15">{{ $block->title }}</p>
                </div>
                <div class="row gap-1">
                    <form action="{{ route('block', $block->block_id) }}">
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
