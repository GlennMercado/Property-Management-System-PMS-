@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">                 
        <!--Cleaned-->
        <div class="row">
            <div class="col-xl">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0 title">Housekeeping</h3>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <select class="form-control" style="border:2px solid" id="optionselect" >
                                    <option value="Cleaned" selected="true">Cleaned</option>
                                    <option value="Out of Service">Out of Service</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <!--Cleaned-->
                        <div class="row align-items-center" id="cleaned2">
                            <div class="col">
                                <h3 class="mb-0 category">Cleaned</h3>
                            </div>
                            <!-- <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div> -->
                        </div>
                        <!--Dirty-->
                        <div class="row align-items-center" id="outofservice2" style="display:none;">
                            <div class="col">
                                <h3 class="mb-0 category2">Out of Service</h3>
                            </div>
                            <!-- <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div> -->
                        </div>
                    </div>

                    <!--Cleaned-->
                    <div class="table-responsive" id="cleaned">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style = "font-size:18px;">Room No.</th>
                                    <th scope="col" style = "font-size:18px;">Booking Status</th>
                                    <!-- <th scope="col" style = "font-size:18px;">Housekeeping Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list2 as $lists2)
                                <tr>
                                    @if($lists2->Housekeeping_Status == 'Cleaned')
                                    <td style = "font-size:16px; color:#000000;">{{ $lists2->Room_No }}</td>
                                    <td style = "font-size:16px; color:#000000;">{{ $lists2->Status}}</td>
                                    <!-- <td style = "font-size:16px; color:#5BDF4A;">{{ $lists2->Housekeeping_Status}}</td> -->
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!--Out of Service-->
                    <div class="table-responsive" id="outofservice" style="display:none;">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style = "font-size:18px;">Room No.</th>
                                    <th scope="col" style = "font-size:18px;">Booking Status</th>
                                    <th scope="col" style = "font-size:18px;">Housekeeper</th>
                                    <th scope="col" style = "font-size:18px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list2 as $lists2)
                                <tr>
                                    @if($lists2->Housekeeping_Status == 'Out of Service')
                                    <td style = "font-size:16px;">{{ $lists2->Room_No }}</td>
                                    <td style = "font-size:16px;">{{ $lists2->Status}}</td>
                                    <td style = "font-size:16px;">{{ $lists2->Room_Attendant}}</td>
                                    <td>
                                        @if($lists2->Room_Attendant == "Unassigned")
                                            <!-- Assign Housekeeper Button -->
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assign{{$lists2->Room_No}}"> 
                                                <i class="bi bi-person-fill"></i>
                                            </button>
                                        @else
                                            <!--Update Status button-->
                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#update{{$lists2->Room_No}}"> 
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            
                                        @endif
                                        <!--Out of Order button-->
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#outoforder{{$lists2->Room_No}}"> 
                                            <i class="bi bi-tools"></i>
                                        </button>
                                    </td>
                                    @endif
                                    <!--Assigning Housekeeper-->
                                    <div class="modal fade" id="assign{{$lists2->Room_No}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-left display-4" id="exampleModalLabel">Assigning Housekeeper</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                        <form method="POST" class="prevent_submit" action="{{url('/assign_housekeepers')}}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="card-body bg-white" style="border-radius: 18px">
                                                            <input type="hidden" name="room_no" value="{{$lists2->Room_No}}" />

                                                            <p class="text-left">Housekeeper: </p>
                                                            <select name="housekeeper" class="form-control" required>
                                                                <option selected="true" disabled="disabled">Select</option>
                                                                <option value="Marie B. Adams">Marie B. Adams</option>
                                                                <option value="Nathan Dela Cruz">Nathan Dela Cruz</option>
                                                                <option value="Mark Delos Santos">Mark Delos Santos</option>
                                                                <option value="Jacob Del Rosario">Jacob Del Rosario</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    <input type="submit" class="btn btn-success prevent_submit" value="Assign" />
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>

                                    <!--Update Housekeeping Status Modal-->
                                    <div class="modal fade" id="update{{$lists2->Room_No}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-left display-4" id="exampleModalLabel">Setting Status</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="card-body bg-white" style="border-radius: 18px">

                                                            <h4 class="text-center">Is the Room {{$lists2->Room_No}}<span class="text-success">CLEANED</span>?</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    <a href="{{ url('/update_housekeeping_stats', ['id' => $lists2->Room_No, 'status' => 'Cleaned']) }}" class="btn btn-success">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Out of Order Rooms Modal-->
                                    <div class="modal fade" id="outoforder{{$lists2->Room_No}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-left display-4" id="exampleModalLabel">Maintenance</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">  
                                                <form action="{{ url('/add_out_of_orders') }}" class="prevent_submit" method="POST"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}       
                                                    <div class="row">                                                       
                                                        <div class="col">
                                                            <!-- Room Number and Facility Type -->
                                                            <p class="text-left">Room No</p>
                                                            <input type="hidden" name="room_no" value="{{$lists2->Room_No}}" />
                                                            <input class="form-control" value="{{$lists2->Room_No}}" readonly />

                                                            <input type="hidden" name="facility_type" value="Hotel Room" />

                                                        </div>
                                                        <div class="col">
                                                            <p class="text-left">Priority Level</p>
                                                            <select name="priority" class="form-control" required>
                                                                <option selected="true" disabled="disabled">Select</option>
                                                                <option value="Low">Low</option>
                                                                <option value="Moderate">Moderate</option>
                                                                <option value="High">High</option>
                                                            </select>
                                                        </div>                                                                                                                  
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="text-left">Description</p>
                                                            <input type="text" class="form-control" name="description" required/>   
                                                        </div>     
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="text-left">Due Date</p>
                                                            <input type="date" class="form-control" name="due_date" required/>   
                                                        </div>  
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    <input type="submit" name="outofordersubmit" class="btn btn-primary" />
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
        
        <br>
        



<script>
    $('.prevent_submit').on('submit', function(){
            $('.prevent_submit').attr('disabled','true');
        });
    $(document).ready(function(){
        $("#optionselect").change(function(){
        var selected = $("option:selected", this).val();
        if(selected == 'Cleaned')
        {    
            $('#cleaned, #cleaned2').show();
            $('#outofservice, #outofservice2').hide();
        }
        else if(selected == 'Out of Service')
        {
            $('#outofservice, #outofservice2').show();
            $('#cleaned, #cleaned2').hide();
        }
    });
    });
</script>        
<style>
    .title{
        text-transform:uppercase;
        font-size:25px;
        letter-spacing:2px;
    }
    .category{
        font-size:22px;
        color:#5BDF4A;
    }
    .category2{
        font-size:22px;
        color:#E46000;
    }
    .tab{
        font-size:100px;
    }
</style> 
    </div>


    
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush