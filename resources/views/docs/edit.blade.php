<x-docs.template :project="$project" :docs="$docs" :doc="$doc">
    <x-slot:title>Docs Edit {{ $doc->name }}</x-slot:title>

    <form action="{{ route('docs.update', [$project, $doc]) }}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input id="name"
                   type="text"
                   class="form-control @error("name") is-invalid @enderror"
                   name="name"
                   value="{{ $doc->name }}"
                   required
                   autofocus>
            <label for="floatingInput">Name</label>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-text mb-3">
            <textarea class="form-control" id="content" rows="20" name="content">{{ $doc->content }}</textarea>
            @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <x-form.submit offset="0">Submit</x-form.submit>
    </form>

</x-docs.template>
