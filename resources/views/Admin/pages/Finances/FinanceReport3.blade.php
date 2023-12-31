@extends('layouts.printpage')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <div class="d-flex p-4">
        <div class="p-1"><img src="{{ asset('nvdcpics') }}/nvdc-logo.png" style="height: 80px; width: 80px"></div>
        <div class="p-2">
            <p class="display-3">NVDC Properties</p>
            <div class="font-weight-bold display-5 mt--3">Brgy, 123 General Luis, Novaliches, Quezon City</div>
        </div>
    </div>
    <p class="display-3 text-center">{{ $title }}</p>
    <div class="row d-flex justify-content-center p-5">
        <div class="container-fluid">
            <table class="table align-items-center table-flush" id="myTable">
                <thead class="thead-light">
                        <tr>
                            <th scope="col" style="font-size:18px;">Payment Status</th>
                            <th scope="col" style="font-size:18px;">Amount</th>
                            <th scope="col" style="font-size:18px;">Gcash Account Name</th>
                            <th scope="col" style="font-size:18px;">Reservation Number</th>
                            <th scope="col" style="font-size:18px;">Guest Name</th>
                            <th scope="col" style="font-size:18px;">Mobile Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $sqls)
                            <tr>
                                <td style="font-size:16px;">{{ $sqls->Payment_Status }}</td>
                                <td style="font-size:16px;">{{ $sqls->Payment }}</td>
                                <td style="font-size:16px;">{{ $sqls->gcash_account_name }}</td>
                                <td style="font-size:16px;">{{ $sqls->Booking_No }}</td>
                                <td style="font-size:16px;">{{ $sqls->Guest_Name }}</td>
                                <td style="font-size:16px;">{{ $sqls->Mobile_Num }}</td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
