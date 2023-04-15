<div class="breadcrumb-menu mt-0 mb-4">
    <?php
    $request_params = request()->all();
    $hold_array = array();
    foreach ($request_params as $key => $params) {
        if (!empty($params)) {
            $hold_array[$key] = $params;
        }
    }
    $count = 1;
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('home.index') }}">Home</a>
            </li>
            @if($hold_array)
            @foreach($hold_array as $key => $item)
            @if(count($hold_array) !== $count)
            <li class="breadcrumb-item">
                <a href="{{ route('category.index', http_build_query(['gender'=> strtolower(request()->gender), 'type' => strtolower(request()->type), 'subtype' => strtolower(request()->subtype)])) }}" class="mt-3">
                    {{ ucfirst($item) }}
                </a>
            </li>
            @else
            <li class="breadcrumb-item" aria-current="page">
                {{ ucfirst($item) }}
            </li>
            @endif
            <?php $count++ ?>
            @endforeach
            @endif
        </ol>
    </nav>
</div>