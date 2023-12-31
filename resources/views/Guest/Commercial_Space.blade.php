@extends('layouts.guest', ['title' => __('User Profile')])

@section('content')
    @include('layouts.navbars.navs.guestloggedin')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>


    <div class="content-area">
        <div class="container mt-7">
            <br>
            {{-- Commercial spaces application --}}
            <div class="card bg-white shadow mt-2 mb-2">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Commercial Spaces Application') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th>CONTROL NO.</th>
                                    <th>APPLICATION STATUS</th>
                                    <th>APPLICATION DATE</th>
                                    <th>REMARKS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comm as $comm)
                                    <tr>
                                        <td>
                                            {{ $comm->id }}
                                        </td>
                                        @if ($comm->Status == 'For Approval' || $comm->Status == 'For Interview' || $comm->Status == 'For Revision')
                                            <td>
                                                <span
                                                    class="badge badge-pill badge-primary badge-lg">{{ $comm->Status }}</span>
                                            </td>
                                        @elseif($comm->Status == 'Approved' || $comm->Status == 'Revised' || $comm->Status == 'Tenant' || $comm->Status == 'Passed')
                                            <td>
                                                <span
                                                    class="badge badge-pill badge-success badge-lg">{{ $comm->Status }}</span>
                                            </td>
                                        @elseif($comm->Status == 'Disapproved' || $comm->Status == 'Failed' || $comm->Status == 'Tenant (Terminated)')
                                            <td>
                                                <span
                                                    class="badge badge-pill badge-danger badge-lg">{{ $comm->Status }}</span>
                                            </td>
                                        @endif
                                        <td>
                                            {{ date('F j, y', strtotime($comm->created_at)) }} <br>
                                            {{ date('h:i A', strtotime($comm->created_at)) }}
                                        </td>

                                        <td class="text-primary" >
                                            {{ $comm->Remarks }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#commprev{{ $comm->id }}">View
                                                Appication</button>
                                            @if ($comm->Status == 'For Revision')
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#commedit{{ $comm->id }}">Edit</button>
                                            @endif
                                            @if ($comm->Status == 'Approved')
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#comm_set_interview{{ $comm->id }}">Set
                                                    Interview</button>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- View Application --}}
                                    <div class="modal fade bd-example-modal-lg" id="commprev{{ $comm->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Commercial space applications</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col-md-9">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <h3 class=" mt-6"><span><button class="btn btn-success"
                                                                                disabled="">1</button></span>
                                                                        &nbsp;
                                                                        Commercial Space Inquiry and Application Form
                                                                    </h3>
                                                                </div>
                                                            </div>

                                                            <p class="pt-4">Business Name <span class="text-danger">*</span></p>
                                                            <input type="text" name="business_name" class="form-control mt-2"
                                                                placeholder="Enter Business Name" maxlength="64" required=""
                                                                value="{{ $comm->business_name }}" readonly>
                                                            <p class="pt-4">Business Style/Trade Name (if different from company
                                                                name) <span class="text-danger">*</span> </p>
                                                            <input type="text" name="business_style" class="form-control"
                                                                placeholder="Enter Business Style/Trade Name" maxlength="64"
                                                                required="" value="{{ $comm->business_style }}" readonly>
                                                            <p class="pt-4">Business Address <span class="text-danger">*</span>
                                                            </p>
                                                            <input type="text" name="business_address" class="form-control"
                                                                placeholder="Enter Business Address" maxlength="64" required=""
                                                                value="{{ $comm->business_address }}" readonly>
                                                            <p class="pt-4">Email Address/Website/FB Page <span
                                                                    class="text-danger">*</span>
                                                            </p>
                                                            <input type="text" name="email_website_fb" class="form-control"
                                                                placeholder="Enter Email Address/Website/FB Page..." maxlength="64"
                                                                required="" value="{{ $comm->email_website_fb }}" readonly>
                                                            <div class="row">
                                                                <div class="col-md">

                                                                    <p class="pt-4">Landline No. <span class="text-danger">*</span>
                                                                    </p>
                                                                    <input type="number"
                                                                        onkeypress="if(this.value.length==8) return false;"
                                                                        name="business_landline_no" class="form-control"
                                                                        placeholder="09XXXXXXXX" required=""
                                                                        value="{{ $comm->business_landline_no }}" readonly>
                                                                </div>
                                                                <div class="col-md">
                                                                    <p class="pt-4">Mobile No. <span class="text-danger">*</span>
                                                                    </p>
                                                                    <input type="number"
                                                                        onkeypress="if(this.value.length==10) return false;"
                                                                        name="business_mobile_no" class="form-control"
                                                                        placeholder="09XXXXXXXX" required=""
                                                                        value="{{ $comm->business_mobile_no }}" readonly>
                                                                </div>
                                                            </div>

                                                            <!-- <h4>Owner Details </h4>
                                                                                                                                                                                                                                                <h4>For Single Proprietorship </h4> -->
                                                            <p class="pt-4">Name of owner <span class="text-danger">*</span>
                                                            </p>
                                                            <input type="text" name="name_of_owner" class="form-control"
                                                                placeholder="Enter Name of Owner" maxlength="64" required=""
                                                                value="{{ $comm->name_of_owner }}" readonly>

                                                            <br>
                                                            <p>Spouse <span class="text-danger">*</span> </p>
                                                            <input type="text" name="spouse" class="form-control"
                                                                placeholder="Enter Spouse" maxlength="64" required=""
                                                                value="{{ $comm->spouse }}" readonly>
                                                            <br>
                                                            <p>Home Address <span class="text-danger">*</span> </p>
                                                            <input type="text" name="home_address" class="form-control"
                                                                placeholder="Enter Home Address" maxlength="128" required=""
                                                                value="{{ $comm->home_address }}" readonly>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <br>
                                                                    <p>Landline No <span class="text-danger">*</span> </p>
                                                                    <input type="number"
                                                                        onkeypress="if(this.value.length==8) return false;"
                                                                        name="landline" class="form-control"
                                                                        placeholder="Please use a 8 digit telephone number with no dashes or dots"
                                                                        required="" value="{{ $comm->landline }}" readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <br>
                                                                    <p>Mobile no. <span class="text-danger">*</span> </p>
                                                                    <input type="number"
                                                                        onkeypress="if(this.value.length==10) return false;"
                                                                        name="mobile_no" class="form-control"
                                                                        placeholder="Please use a 10 digit mobile number with no dashes or dots"
                                                                        required="" value="{{ $comm->mobile_no }}" readonly>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <p>Tax Identification No. <span class="text-danger">*</span> </p>
                                                            <input type="number" name="tax_identification_no" class="form-control"
                                                                placeholder="Enter Tax Identification No."
                                                                onkeypress="if(this.value.length==14) return false;" required=""
                                                                value="{{ $comm->tax_identification_no }}" readonly>
                                                            <br>
                                                            <p>Community Tax Certificate No. (Individual) or Other Valid Govt. ID
                                                                No.
                                                                <span class="text-danger">*</span>
                                                            </p>
                                                            <input type="text" name="tax_cert_valid_gov_id" class="form-control"
                                                                placeholder="Enter Home Address" maxlength="128" required=""
                                                                value="{{ $comm->tax_cert_valid_gov_id }}" readonly>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Edit Application --}}
                                    <div class="modal fade bd-example-modal-lg" id="commedit{{ $comm->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Commercial space applications</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ url('/edit_commercial_spaces_application') }}"
                                                    class="prevent_submit" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="col-md-9">
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <h3 class=" mt-6"><span><button class="btn btn-success"
                                                                                    disabled="">1</button></span>
                                                                            &nbsp;
                                                                            Commercial Space Inquiry and Application Form
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="id" value="{{ $comm->id }}" />

                                                                <p class="pt-4">Business Name <span class="text-danger">*</span></p>
                                                                <input type="text" name="business_name" class="form-control mt-2"
                                                                    placeholder="Enter Business Name" maxlength="64"
                                                                    value="{{ $comm->business_name }}" required>

                                                                <p class="pt-4">Business Style/Trade Name (if different from company
                                                                    name) <span class="text-danger">*</span> </p>
                                                                <input type="text" name="business_style" class="form-control"
                                                                    placeholder="Enter Business Style/Trade Name" maxlength="64"
                                                                    value="{{ $comm->business_style }}" required>

                                                                <p class="pt-4">Business Address <span class="text-danger">*</span>
                                                                </p>
                                                                <input type="text" name="business_address" class="form-control"
                                                                    placeholder="Enter Business Address" maxlength="64"
                                                                    value="{{ $comm->business_address }}" required>

                                                                <p class="pt-4">Email Address/Website/FB Page <span
                                                                        class="text-danger">*</span>
                                                                </p>
                                                                <input type="text" name="email_website_fb" class="form-control"
                                                                    placeholder="Enter Email Address/Website/FB Page..."
                                                                    maxlength="64" value="{{ $comm->email_website_fb }}" required>

                                                                <div class="row">
                                                                    <div class="col-md">
                                                                        <p class="pt-4">Business Landline No.
                                                                        </p>
                                                                        <input type="number"
                                                                            onkeypress="if(this.value.length==8) return false;"
                                                                            name="business_landline_no" class="form-control"
                                                                            placeholder="09XXXXXXXX"
                                                                            value="{{ $comm->business_landline_no }}">
                                                                    </div>

                                                                    <div class="col-md">
                                                                        <p class="pt-4">Mobile No. <span
                                                                                class="text-danger">*</span>
                                                                        </p>
                                                                        <input type="number"
                                                                            onkeypress="if(this.value.length==10) return false;"
                                                                            name="business_mobile_no" class="form-control"
                                                                            placeholder="09XXXXXXXX"
                                                                            value="{{ $comm->business_mobile_no }}" required>
                                                                    </div>
                                                                </div>

                                                                <!-- <h4>Owner Details </h4>
                                                                                    <h4>For Single Proprietorship </h4> -->
                                                                <p class="pt-4">Authorized Representative <span
                                                                        class="text-danger">*</span> </p>

                                                                <p class="pt-4">Name of owner <span class="text-danger">*</span>
                                                                </p>
                                                                <input type="text" name="name_of_owner" class="form-control"
                                                                    placeholder="Enter Name of Owner" maxlength="64"
                                                                    value="{{ $comm->name_of_owner }}" required>

                                                                <br>
                                                                <p>Spouse </p>
                                                                <input type="text" name="spouse" class="form-control"
                                                                    placeholder="Enter Spouse" maxlength="64"
                                                                    value="{{ $comm->spouse }}">
                                                                <br>

                                                                <p>Home Address <span class="text-danger">*</span> </p>
                                                                <input type="text" name="home_address" class="form-control"
                                                                    placeholder="Enter Home Address" maxlength="128"
                                                                    value="{{ $comm->home_address }}" required>

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <br>
                                                                        <p>Landline No > </p>
                                                                        <input type="number"
                                                                            onkeypress="if(this.value.length==8) return false;"
                                                                            name="landline" class="form-control"
                                                                            placeholder="Please use a 8 digit telephone number with no dashes or dots"
                                                                            value="{{ $comm->landline }}">
                                                                    </div>
                                                                    <div class="col">
                                                                        <br>
                                                                        <p>Mobile no. <span class="text-danger">*</span> </p>
                                                                        <input type="number"
                                                                            onkeypress="if(this.value.length==10) return false;"
                                                                            name="mobile_no" class="form-control"
                                                                            placeholder="Please use a 10 digit mobile number with no dashes or dots"
                                                                            value="{{ $comm->mobile_no }}" required>
                                                                    </div>
                                                                </div>
                                                                <br>

                                                                <p>Tax Identification No. <span class="text-danger">*</span> </p>
                                                                <input type="number" name="tax_identification_no"
                                                                    class="form-control" placeholder="Enter Tax Identification No."
                                                                    onKeyPress="if(this.value.length==14) return false;"
                                                                    value="{{ $comm->tax_identification_no }}" required>
                                                                <br>
                                                                <p>Upload TIN Image</p>
                                                                <input type="file" accept=".png, .jpeg, .jpg, .gif"
                                                                    maxlength="500000" name="tin_images" class="form-control">
                                                                <br>
                                                                <p>Community Tax Certificate No. (Individual) or Other Valid Govt. ID
                                                                    No. <span class="text-danger">*</span> </p>
                                                                <input type="text" name="tax_cert_valid_gov_id"
                                                                    class="form-control" placeholder="Enter Certificate No."
                                                                    maxlength="128" value="{{ $comm->tax_cert_valid_gov_id }}"
                                                                    required>
                                                                <br>
                                                                <p>Upload Image </p>
                                                                <input type="file" accept=".png, .jpeg, .jpg, .gif"
                                                                    maxlength="500000" name="other_images" class="form-control">
                                                                <br>
                                                                <p class="mt-6">I certify that all of the information I have provided
                                                                    above is
                                                                    true
                                                                    and
                                                                    correct
                                                                    to the best of my knowledge. I fully understand that all data
                                                                    gathered
                                                                    here are
                                                                    required for
                                                                    the evaluation of my application for commercial space lease/rent. I
                                                                    am
                                                                    aware
                                                                    that
                                                                    <span class="text-red">THIS IS
                                                                        NOT CONSIDERED AS A LEASE AGREEMENT/CONTRACT.</span>
                                                                </p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($comm->Status == 'Approved')
                                        {{-- Set Interview --}}
                                        <div class="modal fade interview_modal" id="comm_set_interview{{ $comm->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Commercial space applications
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @foreach ($data as $start_date)
                                                        <input type="hidden" name="start_dates[]"
                                                            value="{{ $start_date['date'] }}">
                                                    @endforeach
                                                    <form action="{{ url('/set_commercial_space_schedule') }}" class="prevent_submit"
                                                        method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{ $comm->id }}">

                                                            <h3 class="text-left">Set Interview Schedule</h3>

                                                            <input type="text" id="interview" class="datepicker"
                                                                name="interview_date" onkeydown="return false" autocomplete="off"
                                                                required>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <br>

            {{-- Commercial Tenant Information --}}
            <div class="card bg-white shadow mt-2 mb-2">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Leased Commercial Space') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <h3>Rent Collection</h3>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th>SPACE/UNIT</th>
                                    <th>Rental Fee</th>
                                    <th>START DATE</th>
                                    <th>END DATE</th>
                                    <th>MONTHLY DUE DATE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $lists)
                                    <tr>
                                        <td>{{ $lists->Space_Unit }}</td>
                                        <td class="cur1">{{ $lists->Rental_Fee }}</td>
                                        <td>{{ date('F j, Y', strtotime($lists->Start_Date)) }}</td>
                                        <td>{{ date('F j, Y', strtotime($lists->End_Date)) }}</td>
                                        <td>{{ date('F j, Y', strtotime($lists->Due_Date)) }}</td>
                                        @if ($lists->Tenant_Status == 'Active (Operating)')
                                            <td class="text-success">{{ $lists->Tenant_Status }}</td>
                                        @else
                                            <td class="text-danger">{{ $lists->Tenant_Status }}</td>
                                        @endif
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#view_payment_history{{ $lists->Tenant_ID }}"
                                                title="Payment History">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            @if ($lists->Tenant_Status != 'Non-Compliance')
                                                @if ($lists->Payment_Status != 'Paid (Checking)' || $lists->Payment_Status == null)
                                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                                        data-target="#update_payment_status{{ $lists->Tenant_ID }}"
                                                        title="Update Payment Status">
                                                        <i class="bi bi-arrow-repeat"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @foreach ($list as $lists)
                        {{-- View Payment History --}}
                        <div class="modal fade" id="view_payment_history{{ $lists->Tenant_ID }}" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-left display-4" id="exampleModalLabel">View
                                            Information History
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3 class="text-left">Payment History</h3>
                                        <table class="table align-items-center table-flush" id="payment_history">
                                            <thead class="thead-light">
                                                <tr>

                                                    <th scope="col">Due Date</th>
                                                    <th scope="col">Rental Fee</th>
                                                    <th scope="col">Paid Date</th>
                                                    <th scope="col">Payment Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list4 as $index => $lists4)
                                                    @if ($lists4->Tenant_ID == $lists->Tenant_ID)
                                                        <tr>
                                                            <td class="font-weight-bold tbltxt">
                                                                {{ date('F j, Y', strtotime($lists4->Due_Date)) }}
                                                            </td>
                                                            <td class="cur1 font-weight-bold tbltxt">
                                                                {{ $lists4->Rental_Fee }}</td>
                                                            @if ($lists4->Paid_Date != null)
                                                                <td class="font-weight-bold tbltxt">
                                                                    {{ date('F j, Y', strtotime($lists4->Paid_Date)) }}
                                                                </td>
                                                            @else
                                                                <td></td>
                                                            @endif
                                                            @if ($lists4->Payment_Status == 'Paid')
                                                                <td class="font-weight-bold tbltxt text-success">
                                                                    {{ $lists4->Payment_Status }}</td>
                                                            @else
                                                                <td class="font-weight-bold tbltxt text-danger">
                                                                    {{ $lists4->Payment_Status }}</td>
                                                            @endif
                                                            <td>
                                                                @if ($lists4->Payment_Status == 'Paid')
                                                                    <button class="preview-btn btn btn-sm btn-primary"
                                                                        data-reference-no="{{ $lists4->Reference_No }}"
                                                                        data-proof-image="{{ $lists4->Proof_Image }}"
                                                                        data-index="{{ $index }}">View
                                                                        Payment</button>

                                                                    <div
                                                                        class="preview-container preview-container-{{ $index }}">
                                                                        <p>Reference Number : <span
                                                                                class="reference-no reference-no-{{ $index }}"></span>
                                                                        </p>
                                                                        @if ($lists4->Proof_Image != null)
                                                                            <p>Proof Image:</p>
                                                                            <img src="{{ $lists4->Proof_Image }}"
                                                                                alt="Proof Image"
                                                                                class="proof-image proof-image-{{ $index }}">
                                                                        @else
                                                                            <i
                                                                                class="proof-image proof-image-{{ $index }}">No
                                                                                proof image available</i>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update Modal -->
                        <div class="modal fade" id="update_payment_status{{ $lists->Tenant_ID }}" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-left display-4" id="exampleModalLabel">Updating
                                            Payment Status
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('commercial_space_rent_payment') }}" class="prevent_submit"
                                        method="POST" enctype="multipart/form-data">

                                        {{ csrf_field() }}

                                        <div class="modal-body">
                                            <input type="hidden" name="tenant_id" value="{{ $lists->Tenant_ID }}">

                                            <input type="hidden" name="rental_fee" value="{{ $lists->Rental_Fee }}">

                                            <input type="hidden" name="total" value="{{ $lists->Total_Amount }}">

                                            <input type="hidden" name="due" value="{{ $lists->Due_Date }}" />

                                            <div class="row shadow p-3 mt-2">
                                                <div class="col-md-12">
                                                    <p class="font-weight-bold text-center">NVDC Properties:
                                                        09458923381
                                                    </p>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    {!! QrCode::size(170)->generate('09458923381') !!}
                                                </div>
                                                <br>
                                                <div class="col-md-12">
                                                    <p class="text-center">Reference Number <span
                                                            class="text-danger">*</span></p>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="number" id="gcash_acc" onkeyup="enable_submit()"
                                                        name="Reference_No" class="form-control" maxlength="13" 
                                                        onkeypress="if(this.value.length==13) return false;"
                                                        required>
                                                </div>
                                                <div class="col-md-12 mt-1">
                                                    <p class="text-center">Upload your proof of payment here </p>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <img id="output" class="img-fluid" />
                                                </div>
                                                <div class="col-md-12 mt-1 mx-auto d-flex justify-content-center">
                                                    <input type="file" accept=".png, .jpeg, .jpg, .gif"
                                                        maxlength="500000" onchange="enable_submit(event)" id="gcash_img"
                                                        placeholder="Ex: John Doe" name="images" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-success prevent_submit"
                                                id="submit_button2">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <br>

                    <h3>Security Deposits</h3>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th>SPACE/UNIT</th>
                                    <th>SECURITY DEPOSIT</th>
                                    <th>PAID DATE</th>
                                    <th>REMARKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list2 as $lists2)
                                    <tr>
                                        <td>{{ $lists2->Space_Unit }}</td>
                                        <td class="cur1">{{ $lists2->Security_Deposit }}</td>
                                        <td>{{ date('F j, Y', strtotime($lists2->Paid_Date)) }}</td>
                                        <td>{{ $lists2->Remarks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <br>

                    <h3>Utility Bills</h3>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th>SPACE/UNIT</th>
                                    <th>TYPE OF BILL</th>
                                    <th>AMOUNT</th>
                                    <th>MONTHLY DUE DATE</th>
                                    <th>PAYMENT STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list3 as $lists3)
                                    <tr>
                                        <td>{{ $lists3->Space_Unit }}</td>
                                        <td>{{ $lists3->Type_of_Bill }}</td>
                                        <td class="cur1">{{ $lists3->Total_Amount }}</td>
                                        <td>{{ date('F j, Y', strtotime($lists->Due_Date)) }}</td>
                                        <td>{{ $lists3->Payment_Status }}</td>
                                        <td>
                                            @if ($lists3->Reference_No != null)
                                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#view_utility_proof{{ $lists3->Tenant_ID . $lists3->Due_Date . $lists3->Type_of_Bill }}"
                                                    title="Payment History">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            @endif
                                            @php $now = date('Y-m-d'); @endphp
                                            @if ($lists3->Payment_Status == null || $lists3->Due_Date == $now)
                                                <button class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#update_utility_payment{{ $lists3->Tenant_ID . $lists3->Due_Date . $lists3->Type_of_Bill }}"
                                                    title="Update Payment Status">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @foreach ($list3 as $lists3)
                        {{-- View Payment History --}}
                        <div class="modal fade"
                            id="view_utility_proof{{ $lists3->Tenant_ID . $lists3->Due_Date . $lists3->Type_of_Bill }}"
                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-left display-4" id="exampleModalLabel">View Proof of
                                            Payment
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3 class="text-left">Type of Bill: <span
                                                class="text-primary">{{ $lists3->Type_of_Bill }}</span></h3>
                                        <h3 class="text-left">Due Date: <span
                                                class="text-primary">{{ date('F j, Y', strtotime($lists3->Due_Date)) }}</span>
                                        </h3>
                                        <br>

                                        <h3 class="text-left">Reference No : <span
                                                class="text-primary">{{ $lists3->Reference_No }}</span></h3>
                                        @if ($lists3->Proof_Image != null)
                                            <h3 class="text-left">Proof Image : </h3>
                                            <img src="{{ $lists3->Proof_Image }}" class="card-img-top" />
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update Modal -->
                        <div class="modal fade"
                            id="update_utility_payment{{ $lists3->Tenant_ID . $lists3->Due_Date . $lists3->Type_of_Bill }}"
                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-left display-4" id="exampleModalLabel">Updating
                                            {{ $lists3->Type_of_Bill }} Payment Status
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('commercial_space_utility_payment') }}" class="prevent_submit"
                                        method="POST" enctype="multipart/form-data">

                                        {{ csrf_field() }}

                                        <div class="modal-body">
                                            <input type="hidden" name="tenant_id" value="{{ $lists3->Tenant_ID }}">

                                            <input type="hidden" name="due" value="{{ $lists3->Due_Date }}">

                                            <input type="hidden" name="type" value="{{ $lists3->Type_of_Bill }}">

                                            <div class="row shadow p-3 mt-2">
                                                <div class="col-md-12">
                                                    <p class="font-weight-bold text-center">NVDC Properties:
                                                        09458923381
                                                    </p>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    {!! QrCode::size(170)->generate('09458923381') !!}
                                                </div>
                                                <br>
                                                <div class="col-md-12">
                                                    <p class="text-center">Reference Number <span
                                                            class="text-danger">*</span></p>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="number"
                                                        id="gcash_acc2_{{ $lists3->Type_of_Bill . $lists3->Tenant_ID . $lists3->Due_Date }}"
                                                        onkeyup="enable_submit2(event, {{ $lists3->Type_of_Bill . $lists3->Tenant_ID . $lists3->Due_Date }})"
                                                        name="Reference_No" class="form-control" maxlength="13"
                                                        onkeypress="if(this.value.length==13) return false;"
                                                        required>
                                                </div>
                                                <div class="col-md-12 mt-1">
                                                    <p class="text-center">Upload your proof of payment here</p>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-center">
                                                    <img id="output2_{{ $lists3->Type_of_Bill . $lists3->Tenant_ID . $lists3->Due_Date }}"
                                                        class="img-fluid" />
                                                </div>
                                                <div class="col-md-12 mt-1 mx-auto d-flex justify-content-center">
                                                    <input type="file" accept=".png, .jpeg, .jpg, .gif"
                                                        maxlength="500000"
                                                        onchange="enable_submit2(event, {{ $lists3->Type_of_Bill . $lists3->Tenant_ID . $lists3->Due_Date }})"
                                                        id="gcash_img2_{{ $lists3->Type_of_Bill . $lists3->Tenant_ID . $lists3->Due_Date }}"
                                                        placeholder="Ex: John Doe" name="images" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-success prevent_submit"
                                                id="submit_button3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <br>

                    <h3>Space/s (Unit)</h3>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th>SPACE/UNIT</th>
                                    <th>Measurement Size</th>
                                    <th>Maintenance Status <br> (Under Maintenance?)</th>
                                    <th>DUE DATE</th>
                                    <th>Rental Fee</th>
                                    <th>Security Deposit</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list5 as $lists5)
                                    <tr>
                                        <td>{{ $lists5->Space_Unit }}</td>
                                        <td>{{ $lists5->Measurement_Size }}</td>
                                        @if ($lists5->Maintenance_Status == 'Yes')
                                            <td class="text-danger">{{ $lists5->Maintenance_Status }}</td>
                                        @else
                                            <td class="text-success">{{ $lists5->Maintenance_Status }}</td>
                                        @endif
                                        <td>{{ date('F j, Y', strtotime($lists5->Due_Date)) }}</td>
                                        <td class="cur1">{{ $lists5->Rental_Fee }}</td>
                                        <td class="cur1">{{ $lists5->Security_Deposit }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#view_maintenance_payment_history_{{ str_replace(' ', '_', $lists5->Space_Unit) . $lists5->Tenant_ID }}"
                                                title="Payment History">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            @if ($lists5->Maintenance_Status == 'Yes' && $lists5->Payment_Status != 'Paid (Checking)')
                                                <button class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#update_units_payment_{{ str_replace(' ', '_', $lists5->Space_Unit) . $lists5->Tenant_ID }}"
                                                    title="Update Payment Status">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach ($list5 as $lists5)
                            {{-- View Payment History --}}
                            <div class="modal fade"
                                id="view_maintenance_payment_history_{{ str_replace(' ', '_', $lists5->Space_Unit) . $lists5->Tenant_ID }}"
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-left display-4" id="exampleModalLabel">View
                                                {{ $lists5->Space_Unit }} Information History
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h3 class="text-left">Payment History</h3>
                                            <table class="table align-items-center table-flush" id="payment_history">
                                                <thead class="thead-light">
                                                    <tr>

                                                        <th scope="col">Maintenance Cost</th>
                                                        <th scope="col">Maintenance Due Date</th>
                                                        <th scope="col">Paid Date</th>
                                                        <th scope="col">Paid By</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($list6 as $lists6)
                                                        @if ($lists6->Tenant_ID == $lists->Tenant_ID)
                                                            <tr>
                                                                <td class="font-weight-bold tbltxt cur1">
                                                                    {{ $lists6->Maintenance_Cost }}</td>
                                                                <td class="font-weight-bold tbltxt">
                                                                    {{ date('F j, Y', strtotime($lists6->Due_Date)) }}
                                                                </td>
                                                                @if ($lists6->Paid_Date != null)
                                                                    <td class="font-weight-bold tbltxt">
                                                                        {{ date('F j, Y', strtotime($lists6->Paid_Date)) }}
                                                                    </td>
                                                                @else
                                                                    <td></td>
                                                                @endif
                                                                @if ($lists6->Paid_By == 'Novadeci')
                                                                    <td class="font-weight-bold tbltxt text-danger"
                                                                        >
                                                                        {{ $lists6->Paid_By }}</td>
                                                                @else
                                                                    <td class="font-weight-bold tbltxt text-success"
                                                                        >
                                                                        {{ $lists6->Paid_By }}</td>
                                                                @endif
                                                                <td>
                                                                    @if ($lists6->Proof_Image != null)
                                                                        <div class="img-container">
                                                                            <button class="btn btn-sm btn-primary"
                                                                                title="View Image">
                                                                                View Image
                                                                                <span class="popup">
                                                                                    <img src="{{ $lists6->Proof_Image }}"
                                                                                        alt="Image Preview">
                                                                                </span>
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                    @if ($lists6->Payment_Status == 'Non-Payment')
                                                                        <button class="btn btn-sm btn-success"
                                                                            data-toggle="modal"
                                                                            data-target="#update_client_maintenance_payment{{ $lists6->id }}"
                                                                            title="Update Payment Status">
                                                                            <i class="bi bi-arrow-repeat"></i>
                                                                        </button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach ($list6 as $lists6)
                                @if ($lists6->Tenant_ID == $lists->Tenant_ID)
                                    <!-- Update Modal -->
                                    <div class="modal fade update_payment_status"
                                        id="update_client_maintenance_payment{{ $lists6->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ url('/update_client_maintenance_payment') }}"
                                                    class="prevent_submit" method="POST" enctype="multipart/form-data">

                                                    {{ csrf_field() }}

                                                    <div class="modal-body">
                                                        <input type="hidden" name="id"
                                                            value="{{ $lists6->id }}">
                                                        <input type="hidden" name="tenant_id"
                                                            value="{{ $lists6->Tenant_ID }}">
                                                        <input type="hidden" name="space_unit"
                                                            value="{{ $lists6->Space_Unit }}">
                                                        <input type="hidden" name="due"
                                                            value="{{ $lists6->Due_Date }}">

                                                        <div class="row shadow p-3 mt-2">
                                                            <div class="col-md-12">
                                                                <p class="font-weight-bold text-center">
                                                                    NVDC Properties:
                                                                    09458923381
                                                                </p>
                                                            </div>
                                                            <div class="col-md-12 d-flex justify-content-center">
                                                                {!! QrCode::size(170)->generate('09458923381') !!}
                                                            </div>
                                                            <br><br>
                                                            <div class="col-md-12">
                                                                <p class="text-center">Reference
                                                                    Number <span class="text-danger">*</span>
                                                                </p>
                                                            </div>
                                                            <br>
                                                            <!-- <div class="col-md-12">
                                                                        <p class="text-left">Account name <span
                                                                                class="text-danger">*</span></p>
                                                                    </div> -->
                                                            <div class="col-md-12">
                                                                <input type="number"
                                                                    id="gcash_acc3"
                                                                    onkeyup="enable_submit3()"
                                                                    name="Reference_No"
                                                                    class="form-control"
                                                                    maxlength="32" 
                                                                    onkeypress="if(this.value.length==13) return false;"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-12 mt-1">
                                                                <p class="text-left">Upload your
                                                                    proof of payment here </p>
                                                            </div>
                                                            <div class="col-md-12 d-flex justify-content-center">
                                                                <img id="output3" class="img-fluid" />
                                                            </div>
                                                            <div
                                                                class="col-md-12 mt-1 mx-auto d-flex justify-content-center">
                                                                <input type="file" accept=".png, .jpeg, .jpg, .gif"
                                                                    maxlength="500000" onchange="enable_submit3(event)"
                                                                    id="gcash_img3" placeholder="Ex: John Doe"
                                                                    name="images" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-danger"
                                                            data-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-success prevent_submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <!-- Update Modal -->
                            <div class="modal fade"
                                id="update_units_payment_{{ str_replace(' ', '_', $lists5->Space_Unit) . $lists5->Tenant_ID }}"
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-left display-4" id="exampleModalLabel">Updating
                                                Maintenance Payment Status
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('commercial_space_maintenance_payment') }}"
                                            class="prevent_submit" method="POST" enctype="multipart/form-data">

                                            {{ csrf_field() }}

                                            <div class="modal-body">
                                                <input type="hidden" name="tenant_id"
                                                    value="{{ $lists5->Tenant_ID }}">

                                                <input type="hidden" name="due"
                                                    value="{{ $lists5->Maintenance_Due_Date }}">

                                                <input type="hidden" name="space_unit"
                                                    value="{{ $lists5->Space_Unit }}">

                                                <div class="row shadow p-3 mt-2">
                                                    <div class="col-md-12">
                                                        <p class="font-weight-bold text-center">NVDC Properties:
                                                            09458923381
                                                        </p>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        {!! QrCode::size(170)->generate('09458923381') !!}
                                                    </div>
                                                    <br>
                                                    <!-- <div class="col-md-12">
                                                                    <p class="text-center">Gcash Account <span
                                                                            class="text-danger">*</span></p>
                                                                </div>
                                                                <br> -->
                                                    <div class="col-md-12">
                                                        <p class="text-left">Reference Number <span
                                                                class="text-danger">*</span></p>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="number" id="gcash_acc3" onkeyup="enable_submit3()"
                                                            name="Reference_No" class="form-control" maxlength="13"
                                                            onkeypress="if(this.value.length==13) return false;"
                                                            required>
                                                    </div>
                                                    <div class="col-md-12 mt-1">
                                                        <p class="text-left">Upload your proof of payment here </p>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <img id="output3" class="img-fluid" />
                                                    </div>
                                                    <div class="col-md-12 mt-1 mx-auto d-flex justify-content-center">
                                                        <input type="file" accept=".png, .jpeg, .jpg, .gif"
                                                            maxlength="500000" onchange="enable_submit3(event)"
                                                            id="gcash_img3" placeholder="Ex: John Doe" name="images"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success prevent_submit"
                                                    id="submit_button4">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <br>
        </div>

        <script>
            $(function() {
                $('.interview_modal').on('shown.bs.modal', function() {
                    $("#interview").datepicker({
                        minDate: 0,
                        buttonImageOnly: true,
                        showOn: "both",
                        format: 'yyyy-mm-dd',
                        buttonImage: "{{ asset('images') }}/calendar2.png",
                        beforeShowDay: function(date) {
                            // Convert date to yyyy-mm-dd format
                            var year = date.getFullYear();
                            var month = ('0' + (date.getMonth() + 1)).slice(-2);
                            var day = ('0' + date.getDate()).slice(-2);
                            var formattedDate = year + '-' + month + '-' + day;

                            // Check if formattedDate is in startDates array
                            var startDates = [];

                            $("input[name='start_dates[]']").each(function() {
                                startDates.push($(this).val());
                            });

                            if (startDates.includes(formattedDate)) {
                                return [false, 'unavailable-date'];
                            } else {
                                return [true, ''];
                            }
                        }
                    });
                });
            });

            function enable_submit() {
                var acc = document.getElementById("gcash_acc");
                var g_img = document.getElementById("gcash_img");
                var submit_button2 = document.getElementById("submit_button2");

                loadfile(event);
            }

            function loadfile(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
            }

            function enable_submit2(event, id) {
                var acc = document.getElementById("gcash_acc2_" + id);
                var g_img = document.getElementById("gcash_img2_" + id);
                var submit_button2 = document.getElementById("submit_button3");
                if (acc.value == "" || g_img.value == "") {
                    submit_button2.disabled = true;
                    submit_button2.style.cursor = "not-allowed";
                    console.log("Submit button disabled");
                } else {
                    submit_button2.disabled = false;
                    submit_button2.style.cursor = "pointer";
                    console.log("Submit button enabled");
                }
                loadfile2(event, id);
            }


            function loadfile2(event, id) {
                console.log("Loadfile2 called");
                var output = document.getElementById('output2_' + id);
                output.src = URL.createObjectURL(event.target.files[0]);
                console.log("URL of file being loaded: ", output.src);
            }

            function enable_submit3() {
                var acc = document.getElementById("gcash_acc3");
                var g_img = document.getElementById("gcash_img3");
                var submit_button2 = document.getElementById("submit_button4");

                loadfile3(event);
            }

            function loadfile3(event) {
                var output = document.getElementById('output3');
                output.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
        <script>
            $(document).ready(function($) {
                $('#payment_history').DataTable({
                    "columnDefs": [{
                        "type": "date",
                        "targets": 0
                    }]
                });
            });

            //Preview Image
            const previewBtns = document.querySelectorAll('.preview-btn');
            previewBtns.forEach(previewBtn => {
                const index = previewBtn.dataset.index;
                const previewContainer = document.querySelector(`.preview-container-${index}`);
                const referenceNo = document.querySelector(`.reference-no-${index}`);
                const proofImage = document.querySelector(`.proof-image-${index}`);

                previewBtn.addEventListener('mouseenter', function() {
                    referenceNo.textContent = previewBtn.dataset.referenceNo;
                    proofImage.src = previewBtn.dataset.proofImage;
                    previewContainer.style.display = 'block';
                });

                previewBtn.addEventListener('mouseleave', function() {
                    previewContainer.style.display = 'none';
                });
            });
        </script>
        <style>
            .preview-container {
                display: none;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #f8f9fa;
                border: 1px solid #dee2e6;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                z-index: 999;
                width: auto;
                height: auto;
                text-align: center;
                justify-content: center;
            }

            .preview-container p {
                margin-bottom: 10px;
                font-size: 14px;
                font-weight: bold;
            }

            .preview-container img {
                max-width: 100%;
                height: auto;
                margin-bottom: 10px;
            }

            .img-container {
                position: relative;
                display: inline-block;
            }

            .img-container img {
                display: block;
                max-width: 100%;
                z-index: 9999;
            }

            .img-container .btn {
                position: relative;
            }

            .img-container .popup {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                visibility: hidden;
                opacity: 0;
                transition: all 0.3s ease-in-out;
            }

            .img-container .btn:hover .popup {
                visibility: visible;
                opacity: 1;
            }

            .img-container .popup img {
                display: block;
                max-width: 80vw;
                max-height: 80vh;
                margin: auto;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }


            .cur1::before {
                content: '₱';
            }

            .datepicker {
                pointer-events: none;
                /* form-control */
                display: block;
                width: 100%;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .datepicker:focus {
                border-color: #80bdff;
                outline: 0;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            .ui-datepicker {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 14px;
                background-color: #fff;
                z-index: 1600 !important;
                /* adjust the z-index to be higher than the modal's z-index */
                position: absolute;
                top: 42% !important;
                left: 45% !important;
                transform: translate(-50%, -50%);
            }

            .ui-datepicker-trigger {
                position: absolute;
                top: 60px;
                right: 0;
                margin-right: 30px;
                cursor: pointer;
                background-image: url("{{ asset('images') }}/calendar2.png}}");
                background-size: 30px 30px;
                width: 30px;
                height: 30px;
            }

            /* Set the color of the datepicker header */
            .ui-datepicker-header {
                background-color: #39D972;
                border: 1px solid #ddd;
                color: #fff;
            }

            /* Set the color of the datepicker days */
            .ui-state-default,
            .ui-widget-content .ui-state-default,
            .ui-widget-header .ui-state-default {
                background-color: #fff;
                border: none;
                color: #333;
            }

            /* Set the color of the selected date */
            .ui-state-active,
            .ui-widget-content .ui-state-active,
            .ui-widget-header .ui-state-active {
                background-color: #6C6C6C;
                border: none;
                color: #fff;
            }

            /* Set the color of the datepicker hover state */
            .ui-state-hover,
            .ui-widget-content .ui-state-hover,
            .ui-widget-header .ui-state-hover {
                background-color: #39D972;
                border: none;
                color: #fff;
            }

            /* Set the color of the datepicker today button */
            .ui-datepicker-current-day {
                background-color: #16BBAE;
                border: none;
                color: #fff;
            }

            /* Set the color of the datepicker navigation icons */
            .ui-icon {
                background-image: none;
                background-color: transparent;
                border: none;
                color: #fff;
            }

            /* Set the color of the datepicker navigation buttons */
            .ui-datepicker-prev,
            .ui-datepicker-next {
                background-image: none;
                background-color: transparent;
                border: none;
                color: #fff;
                font-weight: bold;
            }
        </style>
    @endsection
