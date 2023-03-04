@extends('layouts.welcome_layout', ['class' => 'bg-light'])

@section('content')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
    <div class="container-fluid bg-white mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mt-5 banner1">
                <a href="{{ url('convention_center') }}">
                <img class="img-fluid" src="{{ asset('nvdcpics') }}/nvdcpic1.jpg" title="Convention Center">
                </a>
            </div>
            <div class="col-md-8">
                @foreach ($list as $list)
                    <div class="card float-left gal col-md-3 mt-2" style="min-height: 550px">
                        <img class="card-img-top img1 mt-3" src="{{$list->Hotel_Image}}" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="text-green">₱{{ $list->Rate_per_Night }}</h2>
                            <h5 class="card-title">Room {{ $list->Room_No }}</h5>
                            <p class="card-text">
                            <h4 class="text-muted">Room Size:</h4> {{ $list->Room_Size }}
                            <br>
                            <h4 class="text-muted">Number of Beds:</h4> {{ $list->No_of_Beds }}
                            </p>
                            <a href="{{url('suites')}}" class="text-decoration-none"><button
                                    class="form-control bg-green text-white">Reserve Now</button></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <style>
        .gal img:hover {
            transform: scale(1.01);
        }
        .img1{
            max-width: 100%;
            height: 200px !important;
        }
        .banner1{
            height: 60%;
            width: 100%;
        }
        .banner1 img{

        }
    </style>
@endsection
