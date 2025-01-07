<div class="side-block">
    <div class="flex-column gap-3">
        <div class="flex-column gap-1">
            <div class="flex-row align-items-center flex-wrap space-between ">
                <h4>Projecten and Popups</h4>
                <form action="/addPopup" method="POST">
                    @csrf
                    <button class="AddButton"></button>
                </form>
            </div>
            <input type="text" class="form-control p-4" placeholder="Search...">
        </div>
        <div id="vertical-scroll" class="vertical-scroll">
            <div class="flex-column gap-1">
                <h4>General popups</h4>
                @foreach($data as $item)
                    @if($item->type == 'about_me')
                        <div class="bg-content h-100 rounded flex-column">
                            <div class="block collapsible flex-wrap align-items-center rounded space-between">
                                <h4 class="w-fit-content">{{ $item->title }}</h4>
                                <svg height="30" width="30" viewBox="0 0 20 20" fill="currentColor"
                                     aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M5 7.5a1 1 0 011.5 0l3.5 3.5 3.5-3.5a1 1 0 011.5 0 1 1 0 010 1.5l-4 4a1 1 0 01-1.5 0l-4-4a1 1 0 010-1.5z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="content bg-content rounded">
                                <div class="flex-column p-4 gap-1">
                                    <form action="{{ route('setActive', [$item->popup_id]) }}" method="POST">
                                        @csrf
                                        <button class="button w-100 align-items-center space-between">
                                            <p>Active</p>
                                            <span class="dot {{ $item->active == 1 ? 'active' : 'danger' }}"
                                                  aria-label="Active" role="status"></span>
                                        </button>
                                    </form>
                                    <div class="flex-row w-100 align-items-center gap-1">
                                        <form class="w-100"
                                              action="{{ route('popup', [$item->popup_id, $item->title]) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="button w-100">{{__('Edit')}}</button>
                                        </form>
                                        <form class="w-100"
                                              action="{{ route('deletePopup', $item->popup_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button danger  w-100">{{__('Delete')}}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="flex-column gap-1">
                <h4>Projects</h4>
                @foreach($data as $item)
                    @if($item->type == 'projects')
                        <div class="bg-content rounded flex-column">
                            <div class="block collapsible flex-wrap align-items-center rounded space-between">
                                <h4 class="w-fit-content">{{ $item->title }}</h4>
                                <svg height="30" width="30" viewBox="0 0 20 20" fill="currentColor"
                                     aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M5 7.5a1 1 0 011.5 0l3.5 3.5 3.5-3.5a1 1 0 011.5 0 1 1 0 010 1.5l-4 4a1 1 0 01-1.5 0l-4-4a1 1 0 010-1.5z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="content bg-content rounded">
                                <div class="flex-column p-4 gap-1">
                                    <form action="{{ route('setActive', [$item->popup_id]) }}" method="POST">
                                        @csrf
                                        <button class="button w-100 align-items-center space-between">
                                            <p>Active</p>
                                            <span class="dot {{ $item->active == 1 ? 'active' : 'danger' }}"
                                                  aria-label="Active" role="status"></span>
                                        </button>
                                    </form>
                                    <div class="flex-row w-100 align-items-center gap-1">
                                        <form class="w-100"
                                              action="{{ route('popup', [$item->popup_id, $item->title]) }}">
                                            @csrf
                                            @method('PUT')
                                            <button class="button w-100">{{__('Edit')}}</button>
                                        </form>
                                        <form class="w-100" action="{{ route('deletePopup', $item->popup_id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button danger  w-100">{{__('Delete')}}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
