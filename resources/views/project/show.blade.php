<x-app>
    <x-slot:title>Project: {{ $project->name }}</x-slot:title>

    <div class="container">
        <x-projectHeader :project="$project"/>
    </div>
</x-app>
