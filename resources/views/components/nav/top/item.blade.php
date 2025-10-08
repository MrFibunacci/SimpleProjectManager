<li class="nav-item ">
    <a class="nav-link @if(Request::url() === route($route)) active @endif" href="{{ route($route) }}">{{ $slot }}</a>
</li>
