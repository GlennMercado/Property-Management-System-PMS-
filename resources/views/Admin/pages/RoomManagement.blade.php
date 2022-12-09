@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
 
   
    <div class="container-fluid mt--7">    
        <!--Room Management-->             
        <div class="row">
            <div class="col-xl">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Room Management</h3>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-outline-success" data-toggle="modal" data-target="#add_rooms">
                                    <i class="bi bi-plus"></i>
                                </button>           
                            </div>
                        </div>
                        <br>    
                        <div class="row align-items-center">
                            <!--<button class="btn btn-success active" id="assigned">Assigned</button>
                            <button class="btn btn-warning" id="unassigned">Unassigned</button>-->
                        </div>
                    </div>    

                    <!-- Add Modal -->
                    <div class="modal fade" id="add_rooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-left display-4" id="exampleModalLabel">Add Room</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{url('/add_rooms')}}" class="prevent_submit" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class = "row">
                                            <div class="card-body bg-white" style="border-radius: 18px">                                          
                                                <div class = "row">
                                                    <div class = "col">
                                                        <p class="text-left">Room No. </p>
                                                        <select name="room_no" class="form-control" required>
                                                            <option selected="true" disabled="disabled">Select</option>
                                                                @for($count = 1; $count <=30; $count++)
                                                                    <option value="{{$count}}"> {{ $count }}</option>     
                                                                @endfor
                                                        </select>   
                                                    </div>
                                                    <div class = "col">
                                                        <p class="text-left">Room Size (sq. m.)</p>
                                                        <input class="form-control" type="text" name="room_size" required>
                                                    </div>
                                                </div>           
                                                <br>        
                                                <!--Add Asset Column-->                         
                                                <div class = "row">
                                                    <div class = "col">
                                                        <p class="text-left">No. of Beds </p>
                                                        <select name="no_of_beds" class="form-control" required>
                                                        <option selected="true" disabled="disabled">Select</option>
                                                        <option value="One (1) twin-sized">One (1) twin-sized</option>
                                                        <option value="One (1) queen-sized">One (1) queen-sized</option>
                                                        <option value="One (1) queen-sized & One (1) twin-sized">One (1) queen-sized & One (1) twin-sized</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class = "row">
                                                    <div class = "col">
                                                        <p class="text-left">Extra Bed </p>
                                                            <select name="extra_bed" class="form-control" required>
                                                                <option selected="true" disabled="disabled">Select</option>
                                                                <option value="None">None</option>
                                                                <option value="One (1)">One (1)</option>
                                                            </select>
                                                    </div>
                                                    <div class = "col">
                                                        <p class="text-left">No. of Pax per Room </p>
                                                            <select name="no_of_pax" class="form-control"required>
                                                                <option selected="true" disabled="disabled">Select</option>
                                                                @for($count = 1; $count <=4; $count++)
                                                                    <option value="{{$count}}"> {{ $count }}</option>
                                                                @endfor
                                                            </select> 
                                                    </div>
                                                </div>  

                                                <br>
                                                <p class="text-left">Rate per Night </p>
                                                    <input class="form-control" type="text" name="rate_per_night" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,'$1');" required>
                                                <br>
                                                <p class="text-left">Membership </p>
                                                    <select name="membership" class="form-control" required>
                                                        <option selected="true" disabled="disabled">Select</option>
                                                        <option value="Guests">Guests</option>
                                                        <option value="PCC Officers, Staff and Event Team">PCC Officers, Staff and Event Team</option>
                                                    </select>
                                                <br>
                                                    <p class="text-left">Hotel Image </p>
                                                        <input type="file" name="images" class="form-control" accept="image/png, image/gif, image/jpeg" required />
                                                    </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                            <input type="submit" class="btn btn-success prevent_submit" value="Add" name="submit">
                                        </div>     
                                    </div>                  
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!--View-->
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Room No.</th>
                                    <th scope="col">Room Size</th>
                                    <th scope="col">No. of Beds</th>
                                    <th scope="col">Extra Bed</th>
                                    <th scope="col">Booking Status</th>
                                    
                                    <!--<th scope="col">Guest Preference</th>-->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $lists)
                                    <tr>
                                        <td>{{ $lists->Room_No}}</td>
                                        <td>{{ $lists->Room_Size}}</td>
                                        <td>{{ $lists->No_of_Beds}}</td>
                                        <td>{{ $lists->Extra_Bed}}</td>
                                        <td>{{ $lists->Status}}</td>
                                        <td>
                                            <!--View Button-->
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view{{$lists->Room_No}}"> <i class="bi bi-eye"></i> </button>
                                            <!--Edit Button-->
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit{{$lists->Room_No}}"> <i class="bi bi-pencil-square"></i> </button>
                                            @if($lists->Status != 'Available')
                                                <!--Update Status button-->
                                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#update{{$lists->Room_No}}"> <i class="bi bi-arrow-repeat"></i></button>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- View Modal -->
                                    <div class="modal fade" id="view{{$lists->Room_No}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-left display-4" id="exampleModalLabel">Room {{$lists->Room_No}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="card-body bg-white" style="border-radius: 18px">
                                                            <p class="text-left">Room No. :</p> 
                                                            <input class="form-control" type="text" value="{{$lists->Room_No}}" readonly>
                                                            <br>
                                                            <img src="{{$lists->Hotel_Image}}" class="card-img-top"/>
                                                            <br><br>
                                                            <p class="text-left">Rate per Night: </p>  
                                                            <input class="form-control" type="text" value="{{$lists->Rate_per_Night}}" readonly>
                                                            <br>
                                                            <p class="text-left">Membership </p>
                                                            <input class="form-control" type="text" value="{{$lists->Membership}}" readonly>
                                                            <br>
                                                            <p class="text-left">No. of Pax per Room </p>
                                                            <input class="form-control" type="text" value="{{$lists->No_Pax_Per_Room}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    <!--<input type="submit" class="btn btn-success prevent_submit" value="Submit" />-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit{{$lists->Room_No}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-left display-4" id="exampleModalLabel">Room {{$lists->Room_No}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" class="prevent_submit" action="{{url('/edit_rooms')}}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="card-body bg-white" style="border-radius: 18px">
                                                                <p class="text-left">Room No. :</p> 
                                                                <input type="hidden" name="room_no" value="{{ $lists->Room_No}}">
                                                                <input class="form-control" type="text" value="{{ $lists->Room_No}}" readonly>

                                                                <br>
                                                                <img src="{{$lists->Hotel_Image}}" class="card-img-top"/>
                                                                <br><br>

                                                                <p class="text-left">Room Size (sq. m.) </p>
                                                                <input class="form-control" type="text" name="room_size" value="{{$lists->Room_Size}}" required>
                                                                
                                                                <div class = "row">
                                                                    <div class = "col">
                                                                        <p class="text-left">No. of Beds </p>
                                                                        <select name="no_of_beds" class="form-control" required>
                                                                            <option selected="true" disabled="disabled">Select</option>
                                                                            <option value="One (1) twin-sized">One (1) twin-sized</option>
                                                                            <option value="One (1) queen-sized">One (1) queen-sized</option>
                                                                            <option value="One (1) queen-sized & One (1) twin-sized">One (1) queen-sized & One (1) twin-sized</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>

                                                                <div class = "row">
                                                                    <div class = "col">
                                                                        <p class="text-left">Extra Bed </p>
                                                                        <select name="extra_bed" class="form-control" required>
                                                                            <option selected="true" disabled="disabled">Select</option>
                                                                            <option value="None">None</option>
                                                                            <option value="One (1)">One (1)</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class = "col">
                                                                        <p class="text-left">No. of Pax per Room </p>
                                                                            <select name="no_of_pax" class="form-control" required>
                                                                                <option selected="true" disabled="disabled">Select</option>
                                                                                @for($count = 1; $count <=4; $count++)
                                                                                    <option value="{{$count}}"> {{ $count }}</option>
                                                                                @endfor
                                                                            </select> 
                                                                    </div>
                                                                </div>  

                                                                <br>
                                                                <p class="text-left">Rate per Night </p>
                                                                    <input class="form-control" type="text" name="rate_per_night" value="{{$lists->Rate_per_Night}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,'$1');" required>
                                                                <br>
                                                                <p class="text-left">Membership </p>
                                                                    <select name="membership" class="form-control" required>
                                                                        <option selected="true" disabled="disabled">Select</option>
                                                                        <option value="Guests">Guests</option>
                                                                        <option value="PCC Officers, Staff and Event Team">PCC Officers, Staff and Event Team</option>
                                                                    </select>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                        <input type="submit" class="btn btn-success prevent_submit" value="Submit" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Update Modal-->
                                    <div class="modal fade" id="update{{$lists->Room_No}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-left display-4" id="exampleModalLabel">Room {{$lists->Room_No}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <form method="POST" class="prevent_submit" action="{{url('/update_rooms')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="card-body bg-white" style="border-radius: 18px">

                                                            <!--Room No-->
                                                            <input type="hidden" name="room_no" value="{{$lists->Room_No}}" >
                                                            @if($lists->Status != 'Checked-Out' && $lists->Status != 'Available')
                                                                <p class="text-left">Booking Status :</p> 
                                                                <select name="stats" class="form-control">
                                                                    <option selected="true" disabled="disabled">Select</option>
                                                                    <option value="Available">Available</option>
                                                                    <option value="Reserved">Reserved</option>
                                                                    <option value="Checked-In">Checked-In</option>
                                                                    <option value="Checked-Out">Checked-Out</option>
                                                                </select>
                                                            @endif

                                                            @if($lists->Status == 'Checked-Out' )
                                                                <p class="text-left">Housekeeping Status :</p> 
                                                                <select name="hstats" class="form-control">
                                                                    <option selected="true" disabled="disabled">Select</option>
                                                                    <option value="Cleaned">Cleaned</option>
                                                                    <option value="Dirty">Dirty</option>
                                                                    <option value="Out of Order">Out of Order</option>
                                                                    <option value="Out of Service">Out of Service</option>
                                                                </select>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    <input type="submit" class="btn btn-success prevent_submit" value="Update" />
                                                </div> 
                                            </form>
                                            </div>                     
                                        </div>
                                    </div>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <br><br>
       
        
        
        
        
        <!--<a href="{{ route('Dashboard') }}" class = "btn btn-primary" style = " margin-top:20px; margin-right:10px; color:black; background:#ffffff; border-color:#68DBA9;">
            Go Back
        </a>-->
        
            @include('layouts.footers.auth')
    
    </div>

<script>
     $('.prevent_submit').on('submit', function(){
            $('.prevent_submit').attr('disabled','true');
        });

   /*$(document).ready(function(){
        $('#assigned').click(function(){
            $('#assigned').addClass(' active'); 
            $('#unassigned').removeClass(' active'); 
            $('#unassign').hide();
            $('#assign').show();
        });
    });
    $(document).ready(function(){
        $('#unassigned').click(function(){
            $('#unassigned').addClass(' active'); 
            $('#assigned').removeClass(' active'); 
            $('#unassign').show();
            $('#assign').hide();
        });
    });*/
</script>   
<style>
    p{
        letter-spacing:1px;
        font-weight:lighter;
        font-family:sans-serif;
        color:#909090;
    }
    h5{
        font-family:sans-serif;
    }
</style>

@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
