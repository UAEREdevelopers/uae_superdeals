<li><a href="{{$child_category->link ?? route('show_category', ['category' => $child_category->slug]) }}">{{ $child_category->name }}</a>
@if ($child_category->categories)
    <ul>
        @foreach ($child_category->categories as $childCategory)
            @include('frontend.layouts.child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif
</li>