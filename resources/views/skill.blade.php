<x-app-layout>
    <div class="container gap-1">
        <div class="block justify-center">
            <div class="row w-100 justify-center">
                @foreach($skill as $skills)
                    <h1 class="justify-center">{{ $skills->title }}</h1>
                @endforeach
                <form>
                    <input type="hidden" name="skills_id" value="{{ $skills->skills_id }}">

                    @csrf
                    @method('PUT')
                    <x-primary-button>{{__('Opslaan')}}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
