@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class = "col">
                                    
                                    </a>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style = "float:right;">
                                            Add Stock
                                    </button>
                                </div>
                                <h3 class="mb-0">Inventory Stocks</h3>
                                <h5 class="mb-0" style="text-color:#ff0000">Instructions: Before Starting, See To It That All Inventory Are In The Storage Area</h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Item Description</th>
                                    <th scope="col">Available Stock</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            
                                <tbody>
                                    @foreach ($list as $lists)
                                    <tr>
                                        <td>{{ $lists->name}}</td>
                                        <td>{{ $lists->description}}</td>
                                        <td>{{ $lists->total}}</td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#ModalView{{$lists->productid}}" class="btn btn-primary"><i class="bi bi-eye" style = "padding:2px;">View</i></button>
                                            <button type="button" data-toggle="modal" data-target="#ModalUpdate{{$lists->productid}}" class="btn btn-primary"><i class="bi bi-pencil-square"style = "padding:2px;" >Edit</i></button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <!--View-->
                                    <div class="modal fade text-left" id="ModalView{{$lists->productid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCreate" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title text-left display-4" id="exampleModalCreate">View Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>                    
                                                </div>
                                                <div class="modal-body">
                                                            <form class="needs-validation" novalidate>
                                                                <div class = "row">
                                                                        <div class = "col">
                                                                            <p class="text-left">Stock Name: </p>
                                                                                <input type="text" class="form-control" name="name" value = "{{ $lists->name}}" readonly>
                                                                                    <div class="invalid-feedback">
                                                                                        Stock Name empty
                                                                                    </div>       
                                                                        </div>
                                                                </div>
                                                        <div class="form-group">
                                                            <label for="Stockdetails">Stock Description</label>
                                                                <input type="text" class="form-control" name="description" value = "{{ $lists->description}}" readonly>
                                                                    <div class="invalid-feedback">
                                                                        Stock Details empty
                                                                    </div>

                                                            <label for="Stockdetails">Date :</label>
                                                                <input type="date" class="form-control" name="description" value="{{ date('F j Y', strtotime($lists->date))}}" readonly>
                                                                    <div class="invalid-feedback">
                                                                        Quantity empty
                                                                    </div>

                                                            <label for="Stockdetails">Quantity</label>
                                                                <input type="text" class="form-control" name="total" value = "{{ $lists->total}}" readonly>
                                                                    <div class="invalid-feedback">
                                                                        Quantity empty
                                                                    </div>
                                                            </div>
                                                        <label for="exampleInputPassword1">Category</label>
                                                        <input type="text" class="form-control" name="category" value = "{{ $lists->category}}" readonly>
                                                                <div class="invalid-feedback">
                                                                Stock Details empty
                                                                </div>
                                                    </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-failed" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Modal Update-->
                                    <div class="modal fade text-left" id="ModalUpdate{{ $lists->productid}}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title">{{ __('Update Details') }}</h2>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>                    
                                                </div>
                                                <div class="modal-body">
                                                    <form class="needs-validation" novalidate>
                                                        <div class = "row">
                                                            <div class = "col">
                                                            <p class="text-left">Stock ID: </p>
                                                            <input class="form-control" type="text" value="{{$lists->productid}}" readonly>
                                                        </div>
                                                        <div class = "col">
                                                            <p class="text-left">Stock Name: </p>
                                                            <input type="text" class="form-control" id="Stockname" value="{{$lists->name}}" required>
                                                                <div class="invalid-feedback">
                                                                    Stock Name empty
                                                                </div>       
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Stockdetails">Stock Description</label>
                                                    <input type="text" class="form-control" id="Stockdetails" value="{{$lists->description}}" required>
                                                        <div class="invalid-feedback">
                                                            Stock Details empty
                                                        </div>
                                                            <label for="Stockdetails">Quantity</label>
                                                            <input type="button" class="btn btn-primary" value="{{$lists->in}}" name="in" style="float:center"><input type="button" class="btn btn-primary" name="out" value="{{$lists->out}}"><br>
                                                            <input type="number" class="form-control" name="total" value="{{$lists->total}}" required>
                                                        <div class="invalid-feedback">
                                                            Quantity empty
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Category</label>
                                                    <select class="form-control" name = "category" value="{{ $lists->category}}" required>
                                                    <option value="Invalid">Linens :</option>
                                                    <option>Bed pad - Single</option>
                                                    <option>Fitted Sheet - Single</option>
                                                    <option>Flat Sheet - Single</option>
                                                    <option>Duvet Filler - Single</option>
                                                    <option>Duvet Cover - Single</option>
                                                    <option>Pillows</option>
                                                    <option>Bed pad - Queen</option>
                                                    <option>Fitted Sheet - Queen</option>
                                                    <option>Flat Sheet - Queen</option>
                                                    <option>Duvet Filler - Queen</option>
                                                    <option>Duvet Cover - Queen</option>
                                                    <option>Pillows Case</option>
                                                    <option>Bath Towel</option>
                                                    <option>Hand Towel</option>
                                                    <option>Bath Mat</option>
                                                    <option>Bed Ruuner Queen</option>
                                                    <option>Bed Runner Single</option>
                                                    <option value="Invalid"></option>
                                                    <option value="Invalid">Guest Supplies :</option>
                                                    <option>Bath Soap</option>
                                                    <option>Shampoo</option>
                                                    <option>Dental Kit</option>
                                                    <option>Slippers</option>
                                                    <option>Bottled Water</option>
                                                    <option>Juice</option>
                                                    <option>Coffee</option>
                                                    <option>Creamer</option>
                                                    <option>Sugar - White</>
                                                    <option>Sugar - Brown</option>
                                                    <option value="Invalid"></option>
                                                    <option value="Invalid">Amenities : </option>
                                                    <option>Kettle</option>
                                                    <option>Tray</option>
                                                    <option>Dental Glass</option>
                                                    <option>Teaspoon</option>
                                                    <option>Cup And Saucer</option>
                                                    <option>Hanger</option>
                                                    <option>Door Hang</option>
                                                    </select>   
                                                <div class="invalid-feedback">
                                                                Stock Details empty
                                                </div>
                                            </div>      
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-failed" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Update</button>                       
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!--Table Continue-->
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
    
    
</div>
    </div>

    <!--Add Stock-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-left display-4" id="exampleModalLabel">Create Stocks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('StockCount') }}" class="prevent_submit" method="POST">
                        {{ csrf_field() }}
                    <div class="modal-body">
                        <div class = "row">
                            <div class = "col">
                                <p class="text-left">Stock Name: </p>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name..." required>
                                                    
                            </div>
                        </div>
                        <div class = "row">
                            <div class = "col">
                                <label for="Stockdetails">Stock Description</label>
                                <input type="text" class="form-control" name="description" placeholder="Enter details..." required>
                            </div>
                        </div>
                        <div class = "row">
                            <div class = "col">
                                <label for="Stockdetails">Quantity</label>
                                <input type="number" class="form-control" name="quantity" placeholder="Enter number..." required>
                            </div>
                        </div>
                        <div class = "row">
                            <div class = "col">
                                <label for="exampleInputPassword1">Category</label>
                                <select class="form-control" name = "category" required>
                                    <option value="Invalid">Linens :</option>
                                    <option>Bed pad - Single</option>
                                    <option>Fitted Sheet - Single</option>
                                    <option>Flat Sheet - Single</option>
                                    <option>Duvet Filler - Single</option>
                                    <option>Duvet Cover - Single</option>
                                    <option>Pillows</option>
                                    <option>Bed pad - Queen</option>
                                    <option>Fitted Sheet - Queen</option>
                                    <option>Flat Sheet - Queen</option>
                                    <option>Duvet Filler - Queen</option>
                                    <option>Duvet Cover - Queen</option>
                                    <option>Pillows Case</option>
                                    <option>Bath Towel</option>
                                    <option>Hand Towel</option>
                                    <option>Bath Mat</option>
                                    <option>Bed Ruuner Queen</option>
                                    <option>Bed Runner Single</option>
                                    <option value="Invalid"></option>
                                    <option value="Invalid">Guest Supplies :</option>
                                    <option>Bath Soap</option>
                                    <option>Shampoo</option>
                                    <option>Dental Kit</option>
                                    <option>Slippers</option>
                                    <option>Bottled Water</option>
                                    <option>Juice</option>
                                    <option>Coffee</option>
                                    <option>Creamer</option>
                                    <option>Sugar - White</>
                                    <option>Sugar - Brown</option>
                                    <option value="Invalid"></option>
                                    <option value="Invalid">Amenities : </option>
                                    <option>Kettle</option>
                                    <option>Tray</option>
                                    <option>Dental Glass</option>
                                    <option>Teaspoon</option>
                                    <option>Cup And Saucer</option>
                                    <option>Hanger</option>
                                    <option>Door Hang</option>
                                    </select>
                            </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <input type="submit" class="btn btn-success prevent_submit" value="submit" />                      
                    </div>
                </form>         
            </div>
        </div>
    </div>
    <!-- </div>     
    
            </div>
        </div>
    </div> -->
   



    
    <!--Validation                               
       <script>
                 
        (function() {
            'use strict';
            window.addEventListener('load', function() {  
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
        })();
                    
       </script>-->
    
    @endsection

    @push('js')
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    @endpush