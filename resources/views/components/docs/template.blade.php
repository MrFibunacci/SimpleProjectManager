<x-app>
    <x-slot:title>Project: {{ $project->name }} - {{ $title }}</x-slot:title>

    <div class="container">
        <x-projectHeader :project="$project">
            <div class="col-auto">
                <x-newButton route="docs.create" :routeParameters="['project'=>$project]" label="New doc"/>
            </div>
            @isset($headButton){{ $headButton }}@endisset
        </x-projectHeader>

        <div class="row pt-3">
            <div class="col-2">
                <div class="list-group list-group-flush">
                    @if($docs->isNotEmpty())
                        @foreach($docs as $listDoc)
                            <a href="{{ route('docs.show', [$project, $listDoc]) }}" class="list-group-item @isset($doc) @if($listDoc->id === $doc->id) active @endif @endisset">{{ $listDoc->name }}</a>
                        @endforeach
                    @else
                        <a class="list-group-item disabled">no entries yet</a>
                    @endif
                </div>
            </div>

            <div class="col-md-10">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-app>
