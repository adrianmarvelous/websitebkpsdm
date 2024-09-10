<li>
	<a href="{{ ($child_category->route and Route::has('dashboard.'.$child_category->route)) ? route('dashboard.'.$child_category->route) : 'javascript:void(0);' }}">
		{{ $child_category->nama_menu }}
	</a>
	@if (count($child_category->categories) > 0)
	    <ul class="side-nav-second-level mm-collapse mm-show" aria-expanded="false">
	        @foreach ($child_category->categories as $childCategory)
	            @include('admin.child_category', ['child_category' => $childCategory])
	        @endforeach
	    </ul>
	@else

	@endif

</li>
