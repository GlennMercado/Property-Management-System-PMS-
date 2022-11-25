@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="container-fluid mt--6">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header transparent">
                            <div class = "row">    
                                <div class = "col">
                                    <h2 class="mb-0">Create Inventory</h2>
                                </div>
                            
                        </div>
                        <div class = "row" >
                            <div class="col">
                                <h4>Stocks ID</h4>
                                <input type="text" class = "form-control" placeholder = "Enter Stocks ID" required>
                            </div>
                            <div class="col">
                                <h4>Stocks Name</h4>
                                <input type="text" class = "form-control" placeholder = "Enter Stocks Name" required>
                            </div>
                        </div>
                        <div class = "row" >
                            <div class="col">
                                <h4>Stocks Details</h4>
                                <input type="text" class = "form-control" placeholder = "Enter Stocks Details   " required>
                            </div>
                            <div class="col">
                                <h4>Stocks Name</h4>
                                <input type="text" class = "form-control" placeholder = "Enter Stocks Name" required>
                            </div>
                        </div>
                        <a href="#" class = "btn btn-primary" style = "float:right; margin-top:20px;">
                            Submit
                        </a>
                    </div>
                    
                </div> 
                <!--Fields-->
                
            </div>
        </div>
                    
                    
                



            
        
            @include('layouts.footers.auth')
    </div>
    @endsection

    @push('js')
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    @endpush
<style>
    .cont{

    }
</style>