<div class="row mb-3">
    <label for="{{ $name }}" class="col-md-4 col-form-label text-md-end">{{ $slot }}</label>

    <div class="col-md-6">
        <textarea id="{{ $name }}"
            class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
            @if(isset($required)) required @endif
            autocomplete="@if(isset($autocomplete)) {{$autocomplete}} @else {{ $name }} @endif"
            @if(isset($autofocus)) autofocus @endif {{ $attributes }}
            rows="@if(isset($rows)) {{ $rows }} @else 3 @endif"
        >{{ old($name) }}</textarea>

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
