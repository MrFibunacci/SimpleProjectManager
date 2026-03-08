<x-app>
    <x-slot:title>Project: {{ $project->name }} - Docs craete new</x-slot:title>

    <div class="container">
        <x-projectHeader :project="$project">
            <div class="col-auto">
                <x-newButton route="docs.create" :routeParameters="['project'=>$project]" label="New doc"/>
            </div>
        </x-projectHeader>

        <div class="row pt-3">
            <div class="col-2">

            </div>

            <div class="col-md-10">
                <form action="{{ route('docs.store') }}" method="post">
                    <div class="mb-3">
                        @csrf
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="20"></textarea>
                    </div>
                    <x-form.submit offset="0">Submit</x-form.submit>
                </form>
            </div>
        </div>
    </div>
</x-app>
