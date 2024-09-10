@extends('admin.index')

@section('custom_css')
<!-- third party css -->
<link href="{{asset('assets/admin/plugins')}}/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/admin/plugins')}}/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/admin/plugins')}}/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/admin/plugins')}}/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->
@endsection


@section('content')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Artikel {{$kategori}}</li>
                </ol>
            </div>
            <h4 class="page-title">Artikel {{$kategori}}</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
             

                    <a class="btn btn-success" href="/dashboard/artikel/add">
						<i class="uil-focus-add"></i>
                    	Tambah Data</a>
                    <a class="btn btn-info" href=""><i class="uil-refresh"></i>Refresh</a>

                    <div class="clear"></div>
                    <p></p>
                    <table id="tabel" class="table table-hover table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                @if ($kategori == 'pengajuan')
                                <th>Status</th>
                                @endif
                                <th>Aksi</th>
                            </tr>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($populer as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$data->judul}}</td>
                                <td>{{$data->tanggal}}</td>
                                @if ($kategori == 'pengajuan')
                                <td>
                                    @switch($data->status)
                                        @case(1)
                                            <p style="color: green">Approve</p>
                                            @break
                                        @case(0)
                                            <p style="color: blue">Belum Approve</p>
                                            @break
                                        @case(-1)
                                            <p style="color: red">Ditolak</p>
                                            @break
                                            
                                    @endswitch
                                </td>
                                @endif
                                <td>
                                    <a class="btn btn-info" href="{{asset('assets/artikel/'.$data->file)}}" target="_blank">View PDF</a>
                                    <a class="btn btn-primary" href="/dashboard/artikel/detail/{{$data->id}}">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>


                </div> <!-- end tab-content-->

            </div>  <!-- end card-body -->
        </div>  <!-- end card -->
    </div>  <!-- end col -->

</div>
<!-- end row -->



@endsection


@section('custom_js')

<!-- third party js -->
<script src="{{asset('assets/admin/plugins')}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/dataTables.bootstrap4.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/dataTables.responsive.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/responsive.bootstrap4.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/dataTables.buttons.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/buttons.bootstrap4.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/buttons.html5.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/buttons.flash.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/buttons.print.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/dataTables.keyTable.min.js"></script>
<script src="{{asset('assets/admin/plugins')}}/datatables/dataTables.select.min.js"></script>
<!-- third party js ends -->


@endsection