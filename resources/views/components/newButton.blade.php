<div class="row">
    <div class="col-md-auto">
        <a type="button" class="btn @isset($type){{ $type }}@else btn-primary @endif" href="{{ route($route, $routeParameters ?? []) }}">{{ $label ?? 'New' }}</a>
    </div>
</div>
