<x-app>
    <x-slot:title>Projects</x-slot:title>

    <div class="container">
        <div class="row">
            <div class="col-md-auto">
                <a type="button" class="btn btn-primary" href="{{ route('project.create') }}">New</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Project</th>
                                <th scope="col">Type</th>
                                <th scope="col">Due by</th>
                                <th scope="col">Tasks</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Auth::user()->projects()->get() as $project)
                                <tr>
                                    <th scope="row">{{ $project->name }}</th>
                                    <td></td>
                                    <td>{{ $project->due_date }}</td>
                                    <td>4/10</td>
                                    <td>{{ $project->status()->first()->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app>
