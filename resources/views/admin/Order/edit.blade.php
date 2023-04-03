@extends('layout.dashboard')

@section('content')
<div class="page-content">
    <div class="container-fluid">
    <!-- form start here -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Edit Order</h4>

                <form action="{{ route('orders.update', $order->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="put">

                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Market</label>
                        <select class="form-select @error('market') is-invalid @enderror" name="market_id"
                            id="inputGroupSelect01">
                            @foreach ($markets as $market)
                                <option value="{{ $market->id }}" @if ($market->id == $order->market_id) selected @endif>
                                    {{ $market->name }}
                                </option>
                            @endforeach
                            {{-- <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option> --}}
                        </select>
                    </div>
                    <br/>
                    {{-- order_details --}}
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Order Details</label>
                        <input class="form-control" type="text" name="order_details" value="{{ $order->order_details }}"
                            id="example-text-input">
                    </div>
                    {{-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Order Details</span>
                        </div>
                        <textarea class="form-control" name="order_details"
                            aria-label="With textarea">
                            {{ $order->order_details }}
                        </textarea>
                    </div> --}}
                    {{-- address --}}
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Address Name</label>
                        <input class="form-control" type="text" name="address_name" value="{{ $order->address_name }}"
                            id="example-text-input">
                    </div>
                    {{-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Address Name </span>
                        </div>
                        <textarea class="form-control" name="address_name"
                            aria-label="With textarea">
                            {{ $order->address_name }}
                        </textarea>
                    </div> --}}
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Distance</label>
                        <input class="form-control" type="text" name="distance" value="{{ $order->distance }}"
                            id="example-text-input">
                    </div>

                    <label class="col-form-label">price</label>

                    <div class="input-group">

                        <input type="text" class="form-control" name="price" value="{{ $order->price }}"
                            aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <span class="input-group-text">$</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">User name</label>
                        {{-- <label class="input-group-text" for="inputGroupSelect01">User name</label> --}}
                        <select class="form-select " name="user_id" id="inputGroupSelect01">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($user->id == $order->user_id) selected @endif>
                                    {{ $user->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    {{-- Driver --}}
                    {{-- <div class="form-group">
                        <label class="col-form-label">Driver Name</label> --}}
                        {{-- <label class="input-group-text" for="inputGroupSelect01"></label> --}}
                                    {{-- <select class="form-select" name="user_driver"
                                        id="inputGroupSelect01">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                 @if ($user->id == $order->driver_id) selected @endif>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach

                                    </select>
                    </div> --}}
                        </select>
                    </div>

                    <br>
                    {{-- status --}}
                    <div class="form-group">
                        <label class="col-form-label">Order Status</label>
                                    <select class="form-select" name="status"
                                        id="inputGroupSelect01">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->name }}"  @if ($status->name == $order->status_order) selected @endif>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach

                                    </select>
                    </div>

                    <br>

                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                </form>
            </div>
        </div>
    </div>
    <!-- form end here-->
    </div>
</div>

@endsection

{{-- @section('scripts')

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


@endsection --}}
