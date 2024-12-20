<x-app-layout>
    <div class="container justify-start bg-light-black w-100 rounded h-100">
        <div class="flex-row space-between gap-2">
            <h2>{{__('Dashboard')}}</h2>
            <form action="">
                @csrf
                <x-primary-button>{{__('Add Block')}}</x-primary-button>
            </form>
        </div>
        @foreach($blocks as $block)
            <div class="bg-content rounded flex-column">
                <div class="block collapsible flex-wrap rounded space-between">
                    <h3 class="w-fit-content">{{ $block->type }}</h3>
                    <svg height="30" width="30" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M5 7.5a1 1 0 011.5 0l3.5 3.5 3.5-3.5a1 1 0 011.5 0 1 1 0 010 1.5l-4 4a1 1 0 01-1.5 0l-4-4a1 1 0 010-1.5z"
                              clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="content bg-content rounded">
                    <div class="flex-row justify-end p-1 align-items-center gap-1">
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
            </div>

        @endforeach
    </div>
</x-app-layout>
