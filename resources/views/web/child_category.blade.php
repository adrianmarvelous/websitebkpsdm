<li class="dropdown-item dropright">
	<a class="dropdown-link" @php if (count($child_category->categories) > 0 and ($child_category->narasi==null)){ echo 'data-toggle="dropdown"'; }@endphp href="{{ $child_category->slug ? route('statis', [$child_category->slug]) : 'javascript:void(0);' }}">
		{{ $child_category->judul_konten }}
	</a>
	@if (count($child_category->categories) > 0)
	    <ul class="dropdown-menu">
	        @foreach ($child_category->categories as $childCategory)
	            @include('web.child_category', ['child_category' => $childCategory])
	        @endforeach
	    </ul>
	@else

	@endif

</li>
