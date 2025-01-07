<div class="below-slot-block w-100 align-items-center">
    <!-- Display data for the below slot block -->
    <div id="horizontal-scroll" class="w-100">
        <div class="flex-row horizontal-scroll w-100 gap-1">
            @foreach($data as $item)
                <div class="w-100 p-1 rounded bg-content flex-column">
                    <div class="align-items-center space-between">
                        <h4>{{ $item->title }}</h4>
                    </div>
                    <div class="flex-row w-100 align-items-center gap-1">
                        <form class="w-100" action="{{ route('entrie', $item->entry_id)}}">
                            @csrf
                            @method('PUT')
                            <button class="button w-100">{{__('Edit')}}</button>
                        </form>
                        <form class="w-100" action="{{ route('deleteEntry' , $item->entry_id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="button danger  w-100">{{__('Delete')}}</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <form action="/addEntry" method="POST">
        @csrf
        <button class="AddButton"></button>
    </form>
</div>
