@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>


    <div class="container-fluid mt--7">
        <br>

        <div class="row">
            <div class="col-xl">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="mb-0 title">Reports</h3>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col text-right">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab"
                                            data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                            aria-controls="tabs-icons-text-1" aria-selected="true">Housekeeping</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                            href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                            aria-selected="false"> Supply Request </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                                            href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3"
                                            aria-selected="false"> Maintenance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab"
                                            href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4"
                                            aria-selected="false"> Linen Request</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="tab-content" id="myTabContent">
                                {{-- Arrival / Departure --}}
                                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                    aria-labelledby="tabs-icons-text-1-tab">
                                    <!-- Projects table -->
                                    <table class="table align-items-center table-flush" id="myTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" style="font-size:18px;"> </th>
                                                <th scope="col" style="font-size:18px;">Booking No.</th>
                                                <th scope="col" style="font-size:18px;">Room No.</th>
                                                <th scope="col" style="font-size:18px;">Facility<br>Type</th>
                                                <th scope="col" style="font-size:18px;">Housekeeping<br>Status</th>
                                                <th scope="col" style="font-size:18px;">Attendant</th>
                                                <th scope="col" style="font-size:18px;">Guest Name</th>
                                                <th scope="col" style="font-size:18px;">Check-In<br>Date</th>
                                                <th scope="col" style="font-size:18px;">Check-Out<br>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @php
                                                    $count = 1;
                                                @endphp
                                            @foreach ($list as $lists)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $lists->Booking_No }}</td>
                                                    <td>{{ $lists->Room_No }}</td>
                                                    <td>{{ $lists->Facility_Type }}</td>
                                                    <td>{{ $lists->Housekeeping_Status }}</td>
                                                    <td>{{ $lists->Attendant }}</td>
                                                    <td>{{ $lists->Guest_Name }}</td>
                                                    <td>{{ date('F j Y', strtotime($lists->Check_In_Date)) }}</td>
                                                    <td>{{ date('F j Y', strtotime($lists->Check_Out_Date)) }}</td>
                                                </tr>
                                                @php $count++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Supply Request --}}
                                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                    aria-labelledby="tabs-icons-text-2-tab">
                                    <!-- Projects table -->
                                    <table class="table align-items-center table-flush" id="myTable2">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" style="font-size:18px;">Room No.</th>
                                                <th scope="col" style="font-size:18px;">Item Name</th>
                                                <th scope="col" style="font-size:18px;">Quantity</th>
                                                <th scope="col" style="font-size:18px;">Quantity <br> Requested</th>
                                                <th scope="col" style="font-size:18px;">Attendant</th>
                                                <th scope="col" style="font-size:18px;">Status</th>
                                                <th scope="col" style="font-size:18px;">Date <br> Requested</th>
                                                <th scope="col" style="font-size:18px;">Date <br> Received</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($list3 as $lists)
                                            <tr>
                                                <td>{{$lists->Room_No}}</td>
                                                <td>{{$lists->name}}</td>
                                                <td>{{$lists->Quantity}}</td>
                                                <td>{{$lists->Quantity_Requested}}</td>
                                                <td>{{$lists->Attendant}}</td>
                                                @if($lists->Status == "Approved")
                                                <td style="color:#5cb85c;">{{$lists->Status}}</td>
                                                @else
                                                <td style="color:#d9534f;">{{$lists->Status}}</td>
                                                @endif
                                                <td>{{ date('F j Y', strtotime($lists->Date_Requested)) }} 
                                                    <br> 
                                                    {{date('H:i:s A', strtotime($lists->Date_Requested)) }}
                                                </td>
                                                <td>{{ date('F j Y', strtotime($lists->Date_Received)) }} 
                                                    <br> 
                                                    {{date('H:i:s A', strtotime($lists->Date_Received)) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Maintenance --}}
                                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel"
                                    aria-labelledby="tabs-icons-text-3-tab">
                                    <!-- Projects table -->
                                    <table class="table align-items-center table-flush" id="myTable3">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" style="font-size:18px;"> </th>
                                                <th scope="col" style="font-size:18px;">Booking No.</th>
                                                <th scope="col" style="font-size:18px;">Room No.</th>
                                                <th scope="col" style="font-size:18px;">Facility<br>Type</th>
                                                <th scope="col" style="font-size:18px;">Description</th>
                                                <th scope="col" style="font-size:18px;">Discovered By</th>
                                                <th scope="col" style="font-size:18px;">Priority Level</th>
                                                <th scope="col" style="font-size:18px;">Status</th>
                                                <th scope="col" style="font-size:18px;">Due<br>Date</th>
                                                <th scope="col" style="font-size:18px;">Date<br>Resolved</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @php
                                                    $count = 1;
                                                @endphp
                                            @foreach ($list2 as $lists)                                             
                                                    <tr>
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $lists->Booking_No }}</td>
                                                        <td>{{ $lists->Room_No }}</td>
                                                        <td>{{ $lists->Facility_Type }}</td>
                                                        <td>{{ $lists->Description }}</td>
                                                        <td>{{ $lists->Discovered_By }}</td>
                                                        <td>{{ $lists->Priority_Level }}</td>
                                                        <td>{{ $lists->Status }}</td>
                                                        <td>{{ date('F j Y', strtotime($lists->Due_Date)) }}</td>
                                                        <td>{{ date('F j Y', strtotime($lists->Date_Resolved)) }}</td>
                                                    </tr>
                                                @php $count++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Linen Request --}}
                                <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel"
                                    aria-labelledby="tabs-icons-text-4-tab">
                                    <table class="table align-items-center table-flush" id="myTable2">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" style="font-size:18px;">Room No.</th>
                                                <th scope="col" style="font-size:18px;">Item Name</th>
                                                <th scope="col" style="font-size:18px;">Quantity</th>
                                                <th scope="col" style="font-size:18px;">Quantity <br> Requested</th>
                                                <th scope="col" style="font-size:18px;">Discrepancy</th>
                                                <th scope="col" style="font-size:18px;">Attendant</th>
                                                <th scope="col" style="font-size:18px;">Status</th>
                                                <th scope="col" style="font-size:18px;">Date <br> Requested</th>
                                                <th scope="col" style="font-size:18px;">Date <br> Received</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($list4 as $lists)
                                            <tr>
                                                <td>{{$lists->Room_No}}</td>
                                                <td>{{$lists->name}}</td>
                                                <td>{{$lists->Quantity}}</td>
                                                <td>{{$lists->Quantity_Requested}}</td>
                                                <td>{{$lists->Discrepancy}}</td>
                                                <td>{{$lists->Attendant}}</td>
                                                @if($lists->Status == "Approved")
                                                <td style="color:#5cb85c;">{{$lists->Status}}</td>
                                                @else
                                                <td style="color:#d9534f;">{{$lists->Status}}</td>
                                                @endif
                                                <td>{{ date('F j Y', strtotime($lists->Date_Requested)) }} 
                                                    <br> 
                                                    {{date('H:i:s A', strtotime($lists->Date_Requested)) }}
                                                </td>
                                                <td>{{ date('F j Y', strtotime($lists->Date_Received)) }} 
                                                    <br> 
                                                    {{date('H:i:s A', strtotime($lists->Date_Received)) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>




        <script>
            $('.prevent_submit').on('submit', function() {
                $('.prevent_submit').attr('disabled', 'true');
            });
            $.noConflict();
            jQuery(document).ready(function($) {
                $('#myTable').DataTable();
                $('#myTable2').DataTable();
                $('#myTable3').DataTable();
                $('#myTable4').DataTable();
            });
            // $(document).ready(function() {
            //     $("#optionselect").change(function() {
            //         var selected = $("option:selected", this).val();
            //         if (selected == 'Cleaned') {
            //             $('#cleaned, #cleaned2').show();
            //             $('#outofservice, #outofservice2').hide();
            //         } else if (selected == 'Out of Service') {
            //             $('#outofservice, #outofservice2').show();
            //             $('#cleaned, #cleaned2').hide();
            //         }
            //     });
            // });
        </script>
        <style>
            .title {
                text-transform: uppercase;
                font-size: 25px;
                letter-spacing: 2px;
            }

            .category {
                font-size: 22px;
                color: #5BDF4A;
            }

            .category2 {
                font-size: 22px;
                color: #E46000;
            }

            .tab {
                font-size: 100px;
            }
        </style>

    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
