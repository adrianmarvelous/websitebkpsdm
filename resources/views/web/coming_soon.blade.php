@extends('web.index')


@section('content')
    <section style="background-image: url('{{ asset('assets/images/slider/IMG_2915.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    height:70vh;">
        <div class="container pt-13 mb-5 p-5">
            <div class="row align-items-center">

                <div class="col-12 col-md-12 col-lg-12 ">

                    <!-- Card -->
                    <div class="card shadow-lg mb-2" style="opacity: 0.8">
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 50vh">
                            <p class="text-center display-1" style="font-weight: bold">COMING SOON</p>
                        </div>
                    </div>
                    


                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->
    </section>
@endsection
