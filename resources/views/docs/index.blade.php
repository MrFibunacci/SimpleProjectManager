<x-app>
    <x-slot:title>Project: {{ $project->name }} - Docs</x-slot:title>

    <div class="container">
        <x-projectHeader :project="$project">
            <div class="col-auto">
                <x-newButton route="docs.create" :routeParameters="['project'=>$project]" label="New doc"/>
            </div>
        </x-projectHeader>
        <div class="row pt-3">
            <div class="col-2">
                <div class="list-group list-group-flush">
                    @if($docs->isNotEmpty())
                        @foreach($docs as $doc)
                            <a href="#" class="list-group-item ">{{ $doc->name }}</a>
                        @endforeach
                    @else
                        <a class="list-group-item disabled">no entries yet</a>
                    @endif
                </div>
            </div>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        {!! str("# test")->markdown()  !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
