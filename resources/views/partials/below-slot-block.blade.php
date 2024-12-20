<div class="below-slot-block w-100 align-items-center">
    <!-- Display data for the below slot block -->
    <div class="flex-row w-100 gap-1">
        @foreach($data as $item)
            <div class="w-100 rounded flex-column">
                <div class=" rounded p-5 align-items-center space-between">
                    {{ $item->title }}
                    <svg height="30" width="30" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M5 7.5a1 1 0 011.5 0l3.5 3.5 3.5-3.5a1 1 0 011.5 0 1 1 0 010 1.5l-4 4a1 1 0 01-1.5 0l-4-4a1 1 0 010-1.5z"
                              clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="bg-content rounded">
                    <div class="flex-row justify-end p-1 align-items-center gap-1">
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
            </div>
        @endforeach
    </div>
    <button class="AddButton"></button>
</div>
