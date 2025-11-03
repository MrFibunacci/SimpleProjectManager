<div class="row mb-3">
    <label for="{{ $name }}" class="col-md-4 col-form-label text-md-end">{{ $slot }}</label>

    <div class="col-md-6">
        <input id="{{ $name }}"
            type=@if(!isset($type) && ($name == 'email' || 'search' || 'number' || 'date')) "{{ $name }}" @else "{{ $type }}" @endif
            class="form-control @error($name) is-invalid @enderror"name="{{ $name }}"
            value="@if(isset($value)){{ $value }}@else{{ old($name) }}@endif"
            @if(isset($required)) required @endif
            autocomplete="@if(isset($autocomplete)) {{$autocomplete}} @else {{ $name }} @endif"
            @if(isset($autofocus)) autofocus @endif {{ $attributes }}
        >

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
