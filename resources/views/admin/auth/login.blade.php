
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Website BKD Kota Surabaya</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->

        <!-- App css -->
        <link href="{{asset('assets/admin')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/admin')}}/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{asset('assets/admin')}}/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header pt-4 pb-4 text-center bg-primary">
                                <a class="text-light" href="{{route('index_web')}}">
                                    <h4 class="text-center mt-0 font-weight-bold">Website BKD Kota Surabaya</h4>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign In</h4>
                                </div>

                                <form action="#" method="post" id="form">

                                    @if(session('message'))
                                    <div class="alert alert-{{session('color')}}">
                                        {{session('message') ?? ''}}
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input autocomplete="off" class="form-control" type="text" name="username" id="username" required="" placeholder="Masukkan Username">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input autocomplete="off" type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
                                    </div>

                                    <div class="form-group">
                                        
                                        <div class="g-recaptcha" data-sitekey="6LfL87UoAAAAABWD1RdSIfqy82bM-mPZb6NumgpX"></div>
                                        {{-- <label for=""> 
                                            <h4 ><strong class="text-success" id="teks_penjumlahan">{{$angka1}} + {{$angka2}}</strong></h4>
                                            <a id="refresh_capcay" href="javascript:void(0)">Refresh Kode</a>
                                        </label>
                                        <input autocomplete="off" class="form-control" type="text" name="answer" id="answer" required="" placeholder="Jawaban Pertanyaan Keamanan"> --}}
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit" id="submitform"> <span>Log In</span> </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            BKD KOTA SURABAYA @ 2020
        </footer>

        <!-- bundle -->
        <script src="{{asset('assets/admin')}}/js/vendor.min.js"></script>
        <script src="{{asset('assets/admin')}}/js/app.min.js"></script>
        <script src="{{asset('assets/admin/plugins')}}/swal/sweetalert2@10.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });

        $("#refresh_capcay").click(function(){
            $.ajax({
                url:"{{ route("dashboard.refresh_capcay") }}",
                method:"POST",
                headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                dataType: 'json',
                processData: false,
                contentType: false,
                success:function(data)
                {
                    $('#angka1').val(data.angka1);
                    $('#angka2').val(data.angka2);
                    $('#answer').val('');
                    $('#teks_penjumlahan').html(data.angka1 +' + '+ data.angka2);
                }
            });
        });

        $("#submitform").click(function(){
            $(".text-danger").remove();
            event.preventDefault();
            var data = new FormData($('#form')[0]);
            $("#submitform").attr('disabled', true);
            $("#submitform span").text('Mohon tunggu...');

            $.ajax({
                url:"{{ route("dashboard.form_login_action") }}",
                method:"POST",
                headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                data: data,
                dataType: 'json',
                processData: false,
                contentType: false,
                success:function(data)
                {
                    if($.isEmptyObject(data.error)){

                        if(data.status == "error_server"){
                            $("#submitform").removeAttr('disabled');
                            $("#submitform span").text('Log In');
                            swal.fire("Terjadi kesalahan server !", data.message, "error");
                        }
                        
                        if(data.status == "success"){
                            $("#submitform").removeAttr('disabled');
                            $("#submitform span").text('Log In');
                            $("form").each(function() { this.reset() });
                            location.href = data.redirect;
                        }

                    }else{
                        swal.fire("Ups !", "cek kembali inputan anda", "warning");
                        $("#submitform").removeAttr('disabled');
                        $("#submitform span").text('Log In');
                        $.each(data.error, function(key, value) {
                            var element = $("#" + key);
                            element.closest("div.form-control")
                            .removeClass("text-danger")
                            .addClass(value.length > 0 ? "text-danger" : "")
                            .find("#error_" + key).remove();
                            element.after("<div id=error_"+ key + " class=text-danger>" + value + "</div>");
                        });
                        $.ajax({
                            url:"{{ route("dashboard.refresh_capcay") }}",
                            method:"POST",
                            headers: { "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content") },
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success:function(data)
                            {
                                $('#angka1').val(data.angka1);
                                $('#angka2').val(data.angka2);
                                $('#answer').val('');
                                $('#teks_penjumlahan').html(data.angka1 +' + '+ data.angka2);
                            }
                        });
                    }
                },
                error: function(){
                    swal.fire("Telah terjadi kesalahan pada sistem", "Mohon refresh halaman browser Anda", "error");
                    $("#submitform").removeAttr('disabled');
                    $("#submitform span").text('Log In');
                }
            });
        });




        </script>
        
    </body>
</html>
