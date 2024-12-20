<div class="side-block">
        <div class="flex-column gap-3">
            <div class="flex-column">
                <div class="flex-row align-items-center flex-wrap space-between ">
                    <h4>popups</h4>
                    <button class="AddButton"></button>
                </div>
                <input type="text" class="form-control p-5" placeholder="Search...">
            </div>
            <div class="flex-column gap-1">
                @foreach($data as $item)
                    <button class="collapsible p-4 rounded align-items-center space-between">
                        {{ $item->title }}
                        <svg height="30" width="30" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M5 7.5a1 1 0 011.5 0l3.5 3.5 3.5-3.5a1 1 0 011.5 0 1 1 0 010 1.5l-4 4a1 1 0 01-1.5 0l-4-4a1 1 0 010-1.5z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                @endforeach
            </div>
        </div>

</div>
