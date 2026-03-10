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

</x-docs.template>
