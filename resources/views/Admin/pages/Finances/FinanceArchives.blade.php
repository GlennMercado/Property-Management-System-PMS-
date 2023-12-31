@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#myTable').DataTable();
            $('#myTables').DataTable();
            $('#myTabless').DataTable();
        });
    </script>


    <div class="container-fluid mt--8">
        <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
                <h6 class="h2 text-dark d-inline-block mb-0">Finance Archives</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Finance</li>
                        <li class="breadcrumb-item active text-dark" aria-current="page">Finance Achives</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-xl">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col-md-12 text-right pt-4 mt-4">
                                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab"
                                                data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                                aria-controls="tabs-icons-text-1" aria-selected="true">Proof of Payments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                                href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                                aria-selected="false"> Revenue Archives</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                                                href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3"
                                                aria-selected="false"> Daily Cash Position Report</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Start of Cards-->
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="tab-content" id="myTabContent">
                            {{-- ORs --}}
                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                aria-labelledby="tabs-icons-text-1-tab">
                                <div class="card-header" style="justify-content:center;align-items:censr;align-self:center">
                                    <form action="{{ url('/proof_payment_summary') }}" target="blank" method="get">
                                        <div class="d-flex flex-row">
                                            <div class="p-2">
                                                <label for="start_date">Start Date:</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date"
                                                    required>
                                            </div>
                                            <div class="p-2">
                                                <label for="end_date">End Date:</label>
                                                <input type="date" class="form-control" id="start_date" name="end_date"
                                                    required>
                                            </div>
                                            <div class="p-2">
                                                <label>Generate report:</label>
                                                <button type="submit" class="btn btn-success w-100">
                                                    <label for="">Print</label><span class = "ml-2"><i class="bi bi-printer-fill"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                <table class="table align-items-center table-flush" style="align-items:center"
                                    id="myTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="font-size:18px;">Action</th>
                                            <th scope="col" style="font-size:18px;">Payment Status</th>
                                            <th scope="col" style="font-size:18px;">Amount</th>
                                            <th scope="col" style="font-size:18px;">Gcash Reference number</th>
                                            <th scope="col" style="font-size:18px;">Reservation Number</th>
                                            <th scope="col" style="font-size:18px;">Guest Name</th>
                                            <th scope="col" style="font-size:18px;">Mobile Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sql as $sqls)
                                            <tr>
                                                <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#ModalView{{ $sqls->id }}"
                                                        class="btn btn-sm btn-primary" title="View Finance">
                                                        <i class="bi bi-eye"></i></button>
                                                    <a href="{{ url('/finance_invoice', ['bn' => $sqls->Booking_No]) }}"
                                                        target="blank" class="btn btn-sm btn-success"
                                                        style="cursor:pointer;" title="Invoice">
                                                        <i class="bi bi-file-earmark-text"></i>
                                                    </a>
                                                </td>
                                                <td style="font-size:16px;">{{ $sqls->Payment_Status }}</td>
                                                <td style="font-size:16px;">{{ number_format($sqls->Payment, 2, '.', ',') }}</td>
                                                <td style="font-size:16px;">{{ $sqls->Reference_No }}</td>
                                                <td style="font-size:16px;">{{ $sqls->Booking_No }}</td>
                                                <td style="font-size:16px;">{{ $sqls->Guest_Name }}</td>
                                                <td style="font-size:16px;">{{ $sqls->Mobile_Num }}</td>

                                            </tr>

                                            <!-- Modal -->
                                            <!--View-->
                                            <div class="modal fade text-left" id="ModalView{{ $sqls->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalCreate"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-left display-4"
                                                                id="exampleModalCreate">View
                                                                Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p class="text-left">Room Number: </p>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $sqls->Room_No }}" readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="text-left">Payment Status: </p>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $sqls->Payment_Status }}" readonly>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p class="text-left">Guest Name: </p>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $sqls->Guest_Name }}" readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="text-left">Mobile Number: </p>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ $sqls->Mobile_Num }}" readonly>
                                                                </div>
                                                            </div>

                                                            @if ($sqls->Email != null)
                                                                <br>
                                                                <p class="text-left">Email Address: </p>
                                                                <input class="form-control" type="text"
                                                                    value="{{ $sqls->Email }}" readonly>
                                                            @endif

                                                            <br>
                                                            <p class="text-left">Amount: </p>
                                                            <input class="form-control" type="text"
                                                                value="{{ $sqls->Payment }}" readonly>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <p class="text-left">Check In Date: </p>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ date('F j, Y', strtotime($sqls->Check_In_Date)) }}"
                                                                        readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <p class="text-left">Check Out Date: </p>
                                                                    <input class="form-control" type="text"
                                                                        value="{{ date('F j, Y', strtotime($sqls->Check_Out_Date)) }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <p class="text-left">Proof of Payment </p>
                                                            <img src="{{ $sqls->Proof_Image }}" class="card-img-top" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Revenue ARCHIVES --}}
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                aria-labelledby="tabs-icons-text-2-tab">
                                <div class="table-responsive">
                                    <h4 class="mb-0" style="color:#e40808; font-size:14px;">Instructions: The Report
                                        Page is in a Landscape Mode </h4>
                                    <div class="card-header"
                                        style="justify-content:center;align-items:censr;align-self:center">
                                        <form action="{{ url('/archives_summary') }}" target="blank" method="get">
                                            <div class="d-flex flex-row">
                                                <div class="p-2">
                                                    <label for="start_date">Start Date:</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="start_date" required>
                                                </div>
                                                <div class="p-2">
                                                    <label for="end_date">End Date:</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="end_date" required>
                                                </div>
                                                <div class="p-2">
                                                    <label>Generate report:</label>
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <table class="table align-items-center table-flush" style="align-items:center"
                                        id="myTables">
                                        <thead class="thead-light">
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th colspan="4" style="font-size:18px;">Debit</th>
                                                <th colspan="8" style="font-size:18px;">Credit</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" style="font-size:18px;">Particulars</th>
                                                <th scope="col" style="font-size:18px;">Cash/GCash</th>
                                                <th scope="col" style="font-size:18px;">Unearned Income</th>
                                                <th scope="col" style="font-size:18px;">Bank Transfer/Direct to Bank
                                                </th>
                                                <th scope="col" style="font-size:18px;">Cheque</th>
                                                <th scope="col" style="font-size:18px;">Basketball</th>
                                                <th scope="col" style="font-size:18px;">UnearnedIncome</th>
                                                <th scope="col" style="font-size:18px;">OtherIncome</th>
                                                <th scope="col" style="font-size:18px;">ManagementFee</th>
                                                <th scope="col" style="font-size:18px;">
                                                    FunctionRoom/ConventionCenter/Events
                                                <th scope="col" style="font-size:18px;">Hotel</th>
                                                <th scope="col" style="font-size:18px;">Commercial Spaces</th>
                                                <th scope="col" style="font-size:18px;">Output VAT</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list2 as $lists2)
                                                <tr>
                                                    <td style="font-size:16px;">{{ $lists2->particular }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->cash }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->unearned }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->bank }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->cheque }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->basketball }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->unearned }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->otherincome }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->managementfee }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->event }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->hotel }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->commercialspace }}</td>
                                                    <td style="font-size:16px;">{{ $lists2->outputvat }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <td></td>
                                            <td style="font-size:16px;">{{ $cash_sum }}</td>
                                            <td style="font-size:16px;">{{ $unearned_sum }}</td>
                                            <td style="font-size:16px;">{{ $bank_sum }}</td>
                                            <td style="font-size:16px;">{{ $cheque_sum }}</td>
                                            <td style="font-size:16px;">{{ $basketball_sum }}</td>
                                            <td style="font-size:16px;">{{ $unearned_sum }}</td>
                                            <td style="font-size:16px;">{{ $otherincome_sum }}</td>
                                            <td style="font-size:16px;">{{ $managementfee_sum }}</td>
                                            <td style="font-size:16px;">{{ $event_sum }}</td>
                                            <td style="font-size:16px;">{{ $hotel_sum }}</td>
                                            <td style="font-size:16px;">{{ $commercialspace_sum }}</td>
                                            <td style="font-size:16px;">{{ $output_sum }}</td>
                                            <tfoot>
                                            </tfoot>
                                    </table>
                                </div>
                            </div>

                            {{-- Daily Cash Position Report --}}
                            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel"
                                aria-labelledby="tabs-icons-text-3-tab">
                                <div class="table-responsive">
                                    <h4 class="mb-0" style="color:#e40808; font-size:14px;">Instructions: The Report
                                        Page is in a Landscape Mode </h4>
                                    <div class="card-header"
                                        style="justify-content:center;align-items:censr;align-self:center">
                                        <form action="{{ url('/dcpr_summary') }}" target="blank" method="get">
                                            <div class="d-flex flex-row">
                                                <div class="p-2">
                                                    <label for="start_date">Start Date:</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="start_date" required>
                                                </div>
                                                <div class="p-2">
                                                    <label for="end_date">End Date:</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="end_date" required>
                                                </div>
                                                <div class="p-2">
                                                    <label>Generate report:</label>
                                                    <button type="submit" class="btn btn-success w-100">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <table class="table align-items-center table-flush" style="align-items:center"
                                        id="myTabless">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" style="font-size:18px;">Name of Guest/Payee</th>
                                                <th scope="col" style="font-size:18px;">Particulars</th>
                                                <th scope="col" style="font-size:18px;">Gross Charges</th>
                                                <th scope="col" style="font-size:18px;">NET Amount</th>
                                                <th scope="col" style="font-size:18px;">OR No.
                                                </th>
                                                <th scope="col" style="font-size:18px;">Remarks</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list2 as $lists3)
                                                <tr>
                                                    <td style="font-size:16px;">{{ $lists3->payee }}</td>
                                                    <td style="font-size:16px;">{{ $lists3->particular }}</td>
                                                    <td style="font-size:16px;">{{ number_format($lists3->amount, 2, '.', ',') }}</td>
                                                    <td style="font-size:16px;">{{ number_format($lists3->outputvat, 2, '.', ',') }}</td>
                                                    <td style="font-size:16px;">{{ $lists3->ornum }}</td>
                                                    <td style="font-size:16px;">{{ $lists3->remark }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <td style="font-size:16px;">Total Collection Amount:</td>
                                            <td style="font-size:16px;"></td>
                                            <td style="font-size:16px;">{{ number_format($amount_sum, 2, '.', ',') }}</td>
                                            <td style="font-size:16px;"></td>
                                            <td style="font-size:16px;"></td>
                                            <td style="font-size:16px;"></td>
                                            </tfoot>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <style>
        /* disable arrows input type number */
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        p {
            font-family: sans-serif;
        }
    </style>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
