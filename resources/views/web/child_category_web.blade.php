<li class="dropdown-item dropright">
	<a class="dropdown-link" @php if (count($child_category_web->categories) > 0){ echo 'data-toggle="dropdown"'; }@endphp href="{{ $child_category_web->slug ? route($child_category_web->slug) : 'javascript:void(0);' }}">
		{{ $child_category_web->judul_konten }}
	</a>
	@if (count($child_category_web->categories) > 0)
	    <ul class="dropdown-menu">
	        @foreach ($child_category_web->categories as $childCategoryWeb)
	            @include('web.child_category_web', ['child_category_web' => $childCategoryWeb])
	        @endforeach
	    </ul>
	@else

	@endif

</li>
