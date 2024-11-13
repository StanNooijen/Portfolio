<!-- resources/views/components/projecten.blade.php -->
<div class="col">
    <div class="projectTop">
        <div class="row">
            <div class="col">
                <div class="Text">
                    <h1>{{ $title }}</h1>
                    <div class="Languages">
                        @foreach ($languages as $language)
                            <p>{{ $language }}</p>
                        @endforeach
                    </div>
                    <p>{{ $description }}</p>
                </div>
                <button>Meer over project...</button>
            </div>
            <div class="col">
                <img src="{{ asset('images/' . $image) }}" alt="Project Image">
            </div>
        </div>
    </div>
</div>
