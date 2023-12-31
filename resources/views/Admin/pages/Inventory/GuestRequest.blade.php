@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--8">
        <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
                <h6 class="h2 text-dark d-inline-block mb-0">Guest Request</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Inventory</li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Guest Request
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0" style="color:#e40808; font-size:14px;">Instructions: Before Starting, See
                                    To It That All Inventory Are In The Storage Area</h4>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush datatable datatable-Stock" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="font-size:16px;">Action</th>
                                    <th scope="col" style="font-size:16px;">Request ID</th>
                                    <th scope="col" style="font-size:16px;">Room Number</th>
                                    <th scope="col" style="font-size:16px;">Booking Number</th>
                                    <th scope="col" style="font-size:16px;">Guest Name</th>
                                    <th scope="col" style="font-size:16px;">Date Requested</th>
                                    <th scope="col" style="font-size:16px;">Item Requested</th>
                                    <th scope="col" style="font-size:16px;">Quantity</th>
                                    <th scope="col" style="font-size:16px;">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($list as $lists)
                                    <tr>
                                        <td style="font-size:16px;">
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                data-target="#update{{ $lists->Request_ID }}">
                                                <i class="bi bi-plus"></i></button>
                                        </td>
                                        <td style="font-size:16px;" class="text-success">{{ $lists->Request_ID }}</td>
                                        <td style="font-size:16px;">{{ $lists->Room_No }}</td>
                                        <td style="font-size:16px;">{{ $lists->Booking_No }}</td>
                                        <td style="font-size:16px;">{{ $lists->Guest_Name }}</td>
                                        <td style="font-size:16px;">{{ date('M j, Y', strtotime($lists->Date_Requested)) }}
                                        </td>
                                        <td style="font-size:16px;">{{ $lists->Request }}</td>
                                        <td style="font-size:16px;">{{ $lists->Quantity }}</td>
                                        <td style="font-size:16px;">{{ $lists->Status }}</td>
                                    </tr>

                                    <!--View-->
                                    <div class="modal fade" id="update{{ $lists->Request_ID }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCreate" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-left display-4" id="exampleModalCreate">
                                                        Update Request
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="text-center">Set Status to Dispersed?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-failed" data-dismiss="modal">Close
                                                    </button>
                                                    <a href="{{ url('/req_up', ['id' => $lists->Request_ID, 'qty' => $lists->Quantity, 'name' => $lists->Request]) }}"
                                                        class="btn btn-success">Yes</a>
                                                </div>
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
    </div>


    </div>
    </div>








    <style>
        .title {
            text-transform: uppercase;
            font-size: 20px;
            letter-spacing: 2px;
        }

        .text-color {
            font-size: 18px;
            color: #6C6C6C;
        }

        .cat {
            color: #000000;
            text-transform: uppercase;
        }
    </style>
    <!-- Script tag for datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script>
        $('.prevent_submit').on('submit', function() {
            $('.prevent_submit').attr('disabled', 'true');
        });
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#stats").change(function() {
                var selected = $("option:selected", this).val();

                if (selected == "Approved") {
                    $('#qty').css({
                        'display': 'block'
                    });
                    $('.qt2').val(0);
                } else if (selected == "Denied") {
                    $('#qty').css({
                        'display': 'none'
                    });
                    $('.qt2').val(0);
                }
            });
        });


        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
                columnDefs: [{
                    orderable: true,
                    className: '',
                    targets: 0
                }]
            });
            $('.datatable-Stock:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
