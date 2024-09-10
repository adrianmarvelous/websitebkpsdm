@extends('web.index')


@section('content')
    <section>
        <div class="container  pt-13">
            <div class="row">

                <div class="col-12 col-md-12 col-lg-12 ">

                    <!-- Card -->
                    <div class="card shadow ">
                        <!-- <div class="card card-border border-success shadow-lg mb-2" data-aos="fade-up"> -->
                        <div class="card-body">

                            <!-- List group -->


                            <!-- Text -->
                            <div class="mr-auto">
                                <h2 class="font-weight-bold mb-1">
                                    {{ $title }}
                                </h2>
                                    
                                @foreach ($images as $item)
                                    <img class="w-100 p-1" src="{{ asset('assets/images/cpns_pppk/'.$item) }}" alt="">
                                @endforeach
                            </div>



                        </div>
                    </div>


                </div>
            </div> <!-- / .row -->
        </div> <!-- / .container -->


    </section>
@endsection
