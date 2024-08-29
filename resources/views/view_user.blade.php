<html>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="{{ asset('public/assets/css/light/custom.css') }}" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/light/plugins/src/table/datatables.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/assets/css/light/plugins/src/table/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/assets/css/light/plugins/src/table/custom_dt_custom.css') }}">
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/assets/css/light/plugins/src/table/datatables.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.3/apexcharts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


</head>


<body>
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <div class="top-tabel">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="card-title">User Details</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-8 position-btn" style="overflow: auto;">
                    <table id="user-details-table" class="table dt-table-hover" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th class="text-center">Field</th>
                                <th class="text-center">Details</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>User Name</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td>{{ $user->date_of_birth }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ $user->gender }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{ $user->state->name }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{ $user->city->name }}</td>
                            </tr>
                            <tr>
                                <td>Profile Image</td>
                                <td><img src="{{ asset('storage/app/public/' . $user->profile_photo) }}" alt="Profile Image" style="width: 100px; height: auto;"></td>
                            </tr>
                            <tr>
                                <td>Profession</td>
                                <td>{{ $professionDetail->profession }}</td>
                            </tr>
                            @if($professionDetail->profession === 'Salaried')
                            <tr>
                                <td>Company Name</td>
                                <td>{{ $professionDetail->company_name }}</td>
                            </tr>
                            <tr>
                                <td>Job Started From</td>
                                <td>{{ $professionDetail->job_started_from }}</td>
                            </tr>
                            @elseif($professionDetail->profession === 'Self-employed')
                            <tr>
                                <td>Business Name</td>
                                <td>{{ $professionDetail->business_name }}</td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td>{{ $professionDetail->business_location }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email_address }}</td>
                            </tr>
                            <tr>
                                <td>Mobile No</td>
                                <td>{{ $user->phone_number }}</td>
                            </tr>
                            <tr>
                                <td>Skills</td>
                                <td>
                                    @foreach($skills as $userSkill)
                                        <span class="badge badge-primary">{{ $userSkill->skill->name }}</span>
                                    @endforeach
                                </td>
                            </tr>                            
                            <tr>
                                <td>Education</td>
                                <td>
                                    <ul>
                                        @foreach($educations as $education)
                                            <li>{{ $education->education }} ({{ $education->year_of_completion }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Certificates</td>
                                <td>
                                    <ul>
                                        @foreach($uploadCerticates as $uploadCerticate)
                                            <li><a href="{{ asset('storage/app/public/' . $uploadCerticate->certificate_path) }}" target="_blank">View Certificate</a></li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>