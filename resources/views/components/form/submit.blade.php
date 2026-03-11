<div class="row mb-0">
    <div class="col-md-8 offset-md-@if(isset($offset)){{ $offset }}@else{{ 4 }}@endif">
        <button type="submit" class="btn btn-primary">
            {{ $slot }}
        </button>

        @if(isset($additonalText))
            {{ $additonalText }}
        @endif
    </div>
</div>
