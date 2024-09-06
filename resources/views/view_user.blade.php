@extends('Admin.layouts.master')
@section('content')
    @php
        $currentPage = 'User';
    @endphp
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                <div class="top-tabel">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="d-flex align-items-center justify-content-center pl-2"
                                href="{{ route('index') }}">
                                <img class="back-btn" src="{{ asset('public/assets/img/left-arrow.svg') }}">
                                <h6 class="card-title p-0">View Details</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8 position-btn p-0">
                        <div class="view-details">
                            <div class="simple-tab">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                        aria-labelledby="home-tab" tabindex="0">
                                        <div class="row">
                                            <div class="col-md-6 mb-10 tabs23">
                                                <table>
                                                    <tr class="title"> User Details
                                                        <td>User Name :</td>
                                                        <td>Date of Birth :</td>
                                                        <td>Gender :</td>
                                                        <td>Email :</td>
                                                    </tr>
                                                    <tr class="w-100">

                                                        <td>{{ $user->name ?? 'NA' }}</td>
                                                        <td>{{ $user->date_of_birth ?? 'NA' }}</td>
                                                        <td>{{ $user->gender ?? 'NA' }}</td>
                                                        <td>{{ $user->email_address ?? 'NA' }}</td>

                                                    </tr>



                                                </table>

                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <table>
                                                    <tr class="title">
                                                        <td>State :</td>
                                                        <td>City :</td>
                                                        <td>Profile Image :</td>
                                                        <td>Mobile No</td>

                                                    </tr>
                                                    <tr class="w-100">
                                                        <td>{{ $user->state->name ?? 'NA' }}</td>
                                                        <td>{{ $user->city->name }}</td>
                                                        <td><img src="{{ asset('storage/app/public/' . $user->profile_photo) }}"
                                                                alt="Profile Image" style="width: 100px; height: auto;">
                                                        </td>
                                                        <td>{{ $user->phone_number }}</td>


                                                    </tr>

                                                </table>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <table>
                                                    <tr class="title"> Profession Details
                                                        <td>Profession :</td>
                                                        @if ($professionDetail->profession === 'Salaried')
                                                            <td>Company Name</td>
                                                            <td>Job Started From</td>
                                                        @elseif($professionDetail->profession === 'Self-employed')
                                                            <td>Business Name</td>
                                                            <td>Location</td>
                                                        @endif
                                                    </tr>
                                                    <tr class="w-100">
                                                        <td>{{ $professionDetail->profession ?? 'NA' }}</td>
                                                        <td>{{ $professionDetail->company_name }}</td>
                                                        <td>{{ $professionDetail->job_started_from }}</td>
                                                        <td>{{ $professionDetail->business_name }}</td>
                                                        <td>{{ $professionDetail->business_location }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <table>
                                                    <tr class="title"> Skills Details
                                                        <td>Skills</td>
                                                    </tr>
                                                    <tr class="w-100">
                                                        <td>
                                                            @foreach ($skills as $userSkill)
                                                                <span
                                                                    class="badge badge-primary">{{ $userSkill->skill->name }}</span>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <table>
                                                    <tr class="title"> Education Details
                                                        <td>Education</td>
                                                    </tr>
                                                    <tr class="w-100">
                                                        <td>
                                                            @foreach ($educations as $education)
                                                                <li>{{ $education->education }}
                                                                    ({{ $education->year_of_completion }})
                                                                </li>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <table>
                                                    <tr class="title"> Certificates Details
                                                        <td>Certificates</td>
                                                    </tr>
                                                    <tr class="w-100">
                                                        <td>
                                                            @foreach ($uploadCerticates as $uploadCerticate)
                                                                <li><a href="{{ asset('storage/app/public/' . $uploadCerticate->certificate_path) }}"
                                                                        target="_blank">View Certificate</a></li>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
