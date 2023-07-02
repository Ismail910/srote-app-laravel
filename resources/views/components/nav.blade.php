@php
    $currentRoute = request()->route()->getName();
@endphp

@foreach($items as $item)  
    <div class="user-panel mt-3 pb-3 mb-3 d-flex nav-item">
        <i class="{{ $item['icon'] }}"></i> 
        <a href="{{ route($item['route']) }}" class="d-block nav-link{{ request()->routeIs($item['route']) ? ' bg-primary' : '' }}">
            <p>
                {{ $item['title'] }}
                @if(isset($item['badge']))
                    <span class="right badge badge-danger">New</span>
                @endif
            </p>
        </a>
    </div>
@endforeach
     
   
 