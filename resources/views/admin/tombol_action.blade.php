@foreach($menu as $m)
	<a href="{{$m['action']}}" @if($m['onclick']){{'onclick='.$m['onclick'].''}}@endif class="btn btn-{{$m['color']}} btn-sm">{{$m['teks']}}</a>
@endforeach