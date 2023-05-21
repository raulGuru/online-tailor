<div class="breadcrumb-menu mt-0 mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            @if(request()->gender)
                <li class="breadcrumb-item">
                    <a href="{{ route('category.index', http_build_query(['gender'=> strtolower(request()->gender)])) }}">{{ ucfirst(request()->gender) }}</a>
                </li>
            @endif
            @if(request()->type)
                <li class="breadcrumb-item">
                    <a href="{{ route('category.index', http_build_query(['gender'=> strtolower(request()->gender), 'type' => strtolower(request()->type)])) }}">{{ ucfirst(request()->type) }}</a>
                </li>
            @endif
            @if(request()->subtype)
                <li class="breadcrumb-item">
                    {{ ucfirst(request()->subtype) }}
                </li>
            @endif
            @if(request()->color)
                <li class="breadcrumb-item">
                    {{ ucfirst(request()->color) }}
                </li>
            @endif
        </ol>
    </nav>
</div>