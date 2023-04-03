@extends('layout.dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg profile-setting-img">
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img src="{{ Auth::guard(session('guardName'))->user()->image }}"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                        alt="user-profile-image">
                                    {{-- <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" name="avatar" type="file"
                                            class="profile-img-file-input">
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                        </label>
                                    </div> --}}
                                </div>
                                <h5 class="fs-16 mb-1">{{ $admin->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home"></i> {{__('site.personal_details')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#contact" role="tab">
                                        <i class="far fa-envelope"></i> {{__('site.contact')}}
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <form action="{{ route('admin.profile.update', ['id' => $admin->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label"> {{__('site.name')}}</label>
                                                    <input name="name" type="text" class="form-control"
                                                        id="firstnameInput" placeholder="Enter your firstname"
                                                        value="{{ $admin->name }}">
                                                </div>
                                            </div>
                                            <!--end col-->

                                            {{-- <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number" value="+(1) 987 6543">
                                                </div>
                                            </div> --}}
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">{{__('site.email')}}</label>
                                                    <input name="email" type="email" class="form-control"
                                                        id="emailInput" placeholder="Enter your email"
                                                        value="{{ $admin->email }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="avatar" class="form-label">{{__('site.image')}}</label>
                                                    <input name="avatar" type="file" class="form-control"
                                                        id="avatar" placeholder="Enter your avatar"
                                                        >
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary"



                                                            >{{__('site.update')}}</button>
                                                    <a class="btn btn-soft-success" type="submit" href="{{ route('admin.profile.index') }}">Cancel</a>
                                                    {{-- <button type="button" class="btn btn-soft-success">Cancel</button> --}}
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end tab-pane-->

                                <div class="tab-pane" id="contact" role="tabpanel">
                                    <form action="{{ route('admin.profile.contact.update', ['id' => $contact->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div id="newlink">
                                            <div id="1">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">{{__('site.email')}}</label>
                                                            <input name="email" type="email" class="form-control"
                                                                id="emailInput" placeholder="Enter your email"
                                                                value="{{ $contact->email }}">
                                                        </div>
                                                    </div>
                                                    {{-- end --}}
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="whatsapp" class="form-label">{{__('site.phone_number')}} : </label>
                                                            <input name="whatsapp" type="text" class="form-control"
                                                                id="whatsapp" placeholder="Enter your phone number"
                                                                value="{{ $contact->whatsapp }}">
                                                        </div>
                                                    </div>
                                                    <!--end col-->

                                                    <div class="col-lg-6">

                                                    </div>
                                                    <!--end col-->

                                                </div>
                                                <!--end row-->
                                            </div>
                                        </div>
                                        <div id="newForm" style="display: none;">

                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2">
                                                <button type="submit" class="btn btn-success">{{__('site.update')}}</button>
                                                <a class="btn btn-soft-success" type="submit" href="{{ route('admin.profile.index') }}">{{__('site.cancel')}}</a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </form>
                                </div>
                                <!--end tab-pane-->

                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div>
            <!-- container-fluid -->
        </div><!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Velzon.
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
