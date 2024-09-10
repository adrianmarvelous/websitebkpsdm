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
                    <li class="breadcrumb-item active">{{$judul}}</li>
                </ol>
            </div>
            <h4 class="page-title">{{$judul}}</h4>
        </div>
    </div>
</div>     
<!-- end page title --> 

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <!-- <div class="tab-pane show active" id="horizontal-form-preview">
                        <form class="form-horizontal">
                            <div class="form-group row mb-3">
                                <label for="inputEmail3" class="col-md-3 col-form-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            
                            <div class="form-group mb-0 justify-content-end row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-info  ">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div> -->

                    <div class="alert alert-info">* Hanya 1 (satu) sub slider yang bisa diaktifkan pada halaman depan</div>



                    <a class="btn btn-success" href="{{ Route::has('dashboard.subslider.add') ? route('dashboard.subslider.add') : '#' }}">
						<i class="uil-focus-add"></i>
                    	Tambah Data</a>
                    <a class="btn btn-info" href=""><i class="uil-refresh"></i>Refresh</a>

                    <div class="clear"></div>
                    <p></p>
                    <table id="tabel" class="table table-hover table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Caption</th>
                                <th>Status Aktif</th>
                                <th>Created at</th>
                                <th>Aksi</th>
                            </tr>
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


<script>
$(document).ready( function () {
    $('#tabel').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('dashboard.subslider.datatable') }}',
            method: 'POST'
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
            { data: 'judul' },
            { data: 'aktif' },
            { data: 'created_at' },
            { data: 'action', name: 'action', orderable: false },
        ]
    });
});


function hapus_data(id){
    var id = id;
    swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus data ini ?',
        icon: 'warning',
        showCancelButton: !0,
        confirmButtonText: 'Oke',
        cancelButtonText: 'Batal',
        reverseButtons: !0
    }).then(function (e) {
        if(e.value){
            $.ajax({
                url:'{{route('dashboard.subslider.hapus')}}',
                method:'post',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content') },
                data:{data_id:id},
                success:function(data)
                {
                    if(data.status=='success'){
                        swal.fire({
                            title: "Informasi",
                            text: data.message,
                            icon: "success"
                        }).then(function() {
                            location.href = data.redirect;
                        });
                    }
                },
                error: function()
                {
                    swal.fire("Telah terjadi kesalahan pada sistem", "Mohon refresh halaman browser Anda", "error");
                }
            });
        }else{
            return false;
        }
        
    })
};
</script>
@endsection