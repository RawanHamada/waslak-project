@extends('layout.dashboard')

@section('search')
    {{-- <form action="{{ route('orders') }}" method="get" class="d-flex">
        <input style="height: 50px; margin-top:10px" type="text" name="details" class="form-control" placeholder="Order detailes" value="{{ $order_details }}">
        <select style="height: 50px; margin-top:10px" class="form-control" name="status">
            <option value="">All Status</option>
            @foreach (App\Models\Order_status::all() as $status)
            <option value="{{ $status->id }}"
                >
            {{$status->name}}
            </option>
            @endforeach
        </select>
        <button style="height: 50px; margin-top:10px" type="submit" class="btn btn-outline-dark">Search</button>
    </form> --}}
@endsection

@section('content')
    <!-- Striped Rows -->
    <div class="page-content">
        <div class="container-fluid">

            <form action="{{ route('orders') }}" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="{{__('site.search_here')}}" name="search" value="{{ request()->search }}">
                    <button class="btn btn-dark px-5" id="button-addon2">{{__('site.search')}}</button>
                  </div>
            </form>



            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">

                            <h4 class="card-title mb-0 flex-grow-1">{{__('site.all_orders ')}}</h4>


                        </div><!-- end card header -->

                        <div class="card-body">
                            <p class="text-muted mb-4">{{__('site.all_orders_in_app')}}</p>

                            <div class="live-preview">
                                <div class="table-responsive table-card">
                                    <table class="table align-middle table-nowrap table-striped-columns mb-0">
                                        <thead class="table-light">
                                            <tr>

                                                <th scope="col"> {{__('site.id')}} </th>
                                                <th scope="col"> {{__('site.market_name')}} </th>
                                                <th scope="col"> {{__('site.user_name')}} </th>
                                                <th scope="col"> {{__('site.driver_name')}} </th>
                                                <th scope="col"> {{__('site.description')}} </th>
                                                <th scope="col"> {{__('site.address_name')}} </th>
                                                <th scope="col"> {{__('site.distance')}} </th>
                                                <th scope="col"> {{__('site.price')}} </th>
                                                <th scope="col"> {{__('site.status')}} </th>
                                                <th scope="col" style="width: 150px;">{{__('site.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $result)
                                                <tr>

                                                    <td><a href="#" class="fw-medium">{{ $result->id }}</a></td>

                                                    <td>{{ $result->market->name }}</td>
                                                    <td>{{ $result->user->name }}</td>
                                                    <td>
                                                        @if ($result->driver_id)
                                                        {{ $result->user->name }}

                                                        @else

                                                        <p style="color: rgb(92, 50, 144)">No Driver</p>

                                                        @endif
                                                    </td>
                                                    <td>{{ Str::words($result->order_details, 6, '...') }}</td>
                                                    <td>
                                                        @if ($result->address_name)
                                                        {{ $result->address_name }}

                                                        @else

                                                        <p style="color: red">Unknown</p>

                                                        @endif
                                                    </td>
                                                    <td>{{ $result->distance }}</td>
                                                    <td>{{ $result->price }}</td>

                                                    <td>{{ $result->status_order }}</td>


                                                    <td>
                                                        <ul style="list-style: none" class="d-flex justify-content-center">


                                                            <li style="margin-right: 10px" class="mr-2">

                                                                <a href="{{ route('orders.edit', $result->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>


                                                            </li>

                                                            <li class="mr-2 ml-5">
                                                                <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                                                <form class="d-inline" action="{{ route('orders.delete', $result->id) }}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li>
                                                        </ul>



                                                    </td>
                                            @endforeach

                                        </tbody>

                                    </table>
                                    <div class="" style="padding: 10px">
                                        {{ $orders->links() }}
                                    </div>

                                </div>
                            </div>

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div>
    </div>
@endsection

@section('alerts')
    <x-alerts-js />
@endsection



@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@if (session('msg'))
<script>
    Swal.fire(
    'Good job!',
    '{{ session("msg") }}',
    'success'
    )
</script>
@endif

<script>
    $('.btn-delete').on('click', function() {
        let form = $(this).next('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    })
</script>

@endsection
