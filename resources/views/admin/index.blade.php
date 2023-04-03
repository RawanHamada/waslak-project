@extends('layout.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">{{ __('site.good_morning,') }} {{ Auth::user()->name }}!</h4>
                                    <p class="text-muted mb-0">{{ __('site.what_goinon') }}
                                    </p>
                                </div>

                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                {{ __('site.users') }}</p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                    class="counter-value" data-target="{{ $allUsers->count() }}">{{ $allUsers->count() }}</span> </h4>
                                            <a href="{{ route('admin.users') }}" class="text-decoration-underline">{{ __('site.all_users ') }} </a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-warning rounded fs-3">
                                                <i class="bx bx-user-circle text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                {{ __('site.orders ') }}</p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                    class="counter-value" data-target="{{ $allOrders->count() }}">{{ $allOrders->count() }}</span></h4>
                                            <a href="{{ route('orders') }}" class="text-decoration-underline">{{ __('site.view_all_orders') }}
                                            </a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info rounded fs-3">
                                                <i class="bx bx-shopping-bag text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->





                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                 {{ __('site.complaints') }}</p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ $allComplaints->count()}} </h4>
                                            <a href="{{ route('complaint.index') }}" class="text-decoration-underline"> {{ __('site.view_all_complaints') }}
                                                </a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-success rounded fs-3">
                                                <i class="bx bx-dollar-circle text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->





                       <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                {{ __('site.markets') }}</p>
                                        </div>

                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                    class="counter-value" data-target="{{ $allMarkets->count() }}">{{ $allMarkets->count() }}</span></h4>
                                            <a href="{{ route('market.testindex') }}" class="text-decoration-underline">{{ __('site.view_all_markets') }}</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info rounded fs-3">
                                                <i class="bx bx-shopping-bag text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                    </div> <!-- end row-->


                    <div class="row">
                        <div class="col-xl-">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">{{ __('site.recent_orders') }}</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-info btn-sm">
                                            <i class="ri-file-list-3-line align-middle"></i><a href="{{ route('orders') }}"> {{ __('site.check_all') }}</a>
                                        </button>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table
                                            class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th scope="col">{{ __('site.id') }}</th>
                                                    <th scope="col">{{ __('site.customer') }}</th>
                                                    <th scope="col">{{ __('site.driver') }}</th>
                                                    <th scope="col">{{ __('site.address') }}</th>
                                                    <th scope="col">{{ __('site.price') }}</th>
                                                    <th scope="col">{{ __('site.status') }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order )

                                                <tr>
                                                    <td>
                                                        <a href="apps-ecommerce-order-details.html"
                                                            class="fw-medium link-primary">{{ $order->id }}</a>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">

                                                            <div class="flex-grow-1">{{ $order->user->name }}</div>
                                                        </div>
                                                    </td>
                                                    <td>







                                                        @if ($order->driver_id)
                                                        {{ $order->user->name }}

                                                        @else

                                                        <p style="color: rgb(92, 50, 144)">Unknown</p>

                                                        @endif






                                                    </td>
                                                    <td>
                                                        <span >
                                                            @if ($order->address_name)
                                                            {{ $order->address_name }}

                                                            @else

                                                            <p style="color: red">  Unknown</p>

                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="text-success">${{ $order->price }}</td>
                                                    <td>
                                                        <span class="badge badge-soft-success">{{ $order->status_order }}</span>
                                                    </td>

                                                </tr><!-- end tr -->

                                                @endforeach

                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div>
                                </div>
                            </div> <!-- .card-->
                        </div> <!-- .col-->
                    </div> <!-- end row-->



                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">{{ __('site.recent_customers') }}</h4>

                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table
                                            class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <tbody>
                                                @foreach ($users as $user)
                                                <tr>

                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">{{ $user->id }}</h5>
                                                        <span class="text-muted">Id</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">{{ $user->name }}</h5>
                                                        <span class="text-muted">Name</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">{{ $user->email }}</h5>
                                                        <span class="text-muted">Email</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">{{ $user->orders->count() }}</h5>
                                                        <span class="text-muted">Orders</span>
                                                    </td>

                                                </tr>

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">{{ __('site.recent_tech') }}</h4>

                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table
                                            class="table table-centered table-hover align-middle table-nowrap mb-0">
                                            <tbody>
                                               @foreach ($tech as $item)
                                               <tr>
                                                <td>
                                                    <span class="text-muted">{{ $item->id }}</span>
                                                </td>
                                                <td>
                                                    @if($item->image)
                                                        <img src="{{ asset('uploads/techsuppport/'.$item->image) }} " width="80">

                                                    @else
                                                        <img src="https://mun.rak.ae/Lists/Participations/Attachments/2/test-8.png" width="130">

                                                   @endif

                                                <td>
                                                    <div class="d-flex">

                                                        <div>
                                                            <h5 class="fs-14 my-1 fw-medium">
                                                                <a href="apps-ecommerce-seller-details.html"
                                                                    class="text-reset">{{ $item->user->name }}</a>
                                                            </h5>
                                                            <span class="text-muted">{{ $item->user->email }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">{{ $item->title }}</span>
                                                </td>

                                                <td>
                                                    <span class="text-muted">{{ $item->created_at->diffForHumans() }}</span>
                                                </td>
                                            </tr><!-- end -->
                                               @endforeach

                                            </tbody>
                                        </table><!-- end table -->
                                    </div>


                                </div> <!-- .card-body-->
                            </div> <!-- .card-->
                        </div> <!-- .col-->
                    </div> <!-- end row-->



                </div> <!-- end .h-100-->

            </div> <!-- end col -->


        </div>

    </div>
    <!-- container-fluid -->
</div>

@endsection
