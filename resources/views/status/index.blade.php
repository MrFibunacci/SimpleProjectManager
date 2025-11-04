<x-app>
    <x-slot:title>Statuses Overview</x-slot:title>

    <div class="container">
        <x-newButton route="status.create" />
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{ $status->name }}</td>
                                    <td>
                                        <a href="{{ route('status.destroy', $status) }}"><i class="bi bi-trash-fill"></i></a>
                                        <a href="{{ route('status.edit', $status) }}"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app>
