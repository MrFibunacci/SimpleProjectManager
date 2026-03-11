<x-docs.template :project="$project" :docs="$docs" :doc="$doc">
    <x-slot:title>Docs</x-slot:title>

    <x-slot:headButton>
        <div class="col-auto">
            <x-newButton route="docs.edit" type="btn-secondary" :routeParameters="['project'=>$project, 'doc'=>$doc]" label="Edit"/>
        </div>
    </x-slot:headButton>

    <div class="card">
        <div class="card-body">
            {!! str($doc->content)->markdown()  !!}
        </div>
    </div>

    <div class="row pt-2 justify-content-end">
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Delete
                </button>
                <ul class="dropdown-menu">
                    <form action="{{  route('docs.destroy', ['project' => $project, $doc])  }}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <li><button type="submit" class="dropdown-item">Confirm</button></li>
                    </form>
                </ul>
            </div>
        </div>
    </div>

</x-docs.template>
