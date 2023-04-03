@extends('layout.dashboard')

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="profile-foreground position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg">
                </div>
            </div>
            <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                <div class="row g-4">
                    <div class="col-auto">
                        <div class="avatar-lg">
                            <img style="width: 90px" src="{{ Auth::guard(session('guardName'))->user()->image }}" alt="user-img" class="img-thumbnail rounded-circle" />
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col">
                        <div class="p-2">
                            <h3 class="text-white mb-1">{{ $admin->name }}</h3>
                            <p class="text-white-75">{{__('site.admin')}}</p>
                            <div class="hstack text-white-50 gap-1">
                                <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{__('site.saudi_rabia')}}</div>

                            </div>
                        </div>
                    </div>


                </div>
                <!--end row-->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                            <!-- Nav tabs -->
                            <div style="text-align: center" class="flex-shrink-0">
                                <a  href=" {{route('admin.profile.edit', Auth::guard(session('guardName'))->user()->id)}} " class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> {{__('site.edite_profile')}}</a>
                            </div>
                        <!-- Tab panes -->
                        <div class="tab-content pt-4 text-muted">
                            <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-3">

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">{{__('site.info')}}</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row"> {{__('site.name')}} :</th>
                                                                <td class="text-muted">{{ $admin->name }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th class="ps-0" scope="row">{{__('site.email')}} :</th>
                                                                <td class="text-muted">{{ $admin->email }}</td>
                                                            </tr>




                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- end card body -->

                                            <div class="card-body">
                                                <h5 class="card-title mb-3">{{__('site.contact')}}</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row">{{__('site.email')}} :</th>
                                                                <td class="text-muted">{{ $contact->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">{{__('site.phone_number')}} :</th>
                                                                <td class="text-muted">{{ $contact->whatsapp }}</td>
                                                            </tr>



                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->



                                    </div>
                                    <!--end col-->

                                </div>
                                <!--end row-->
                            </div>



                        </div>
                        <!--end tab-content-->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container-fluid -->
    </div><!-- End Page-content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Velzon.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Themesbrand
                    </div>
                </div>
            </div>
        </div>
    </footer>
<!-- end main content-->

@endsection
