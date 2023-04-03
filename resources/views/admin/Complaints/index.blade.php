@extends('layout.dashboard')

@section('content')
<!-- Rounded Ribbon -->
<div class="page-content">

    <div class="container-fluid">



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{__('site.all_complaints')}}</h4>


            </div><!-- end card header -->

            <div class="card-body">
                <p class="text-muted mb-4">{{__('site.all_complaints_from_customers')}}</p>

                <div class="live-preview">
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap table-striped-columns mb-0">
                            <thead class="table-light">
                                <tr>

                                    <th scope="col">{{__('site.id')}}</th>
                                    <th scope="col">{{__('site.customer_name')}}</th>
                                    <th scope="col">{{__('site.image')}}</th>
                                    <th scope="col">{{__('site.title')}}</th>
                                    <th scope="col">{{__('site.description')}}</th>
                                     <th scope="col">{{__('site.created_at')}}</th>
                                    {{-- <th scope="col"></th> --}}
                                    <th scope="col" style="width: 150px;">{{__('site.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($complaints as $item)
                             <tr>

                                <td><a href="#" class="fw-medium">{{ $item->id }}</a></td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('uploads/techsuppport/'.$item->image) }} " width="80">

                                    @else
                                        <img src="https://mun.rak.ae/Lists/Participations/Attachments/2/test-8.png" width="130">

                                    @endif
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                {{-- <td><span class="badge bg-success">Test</span></td> --}}

                                <td>
                                    <button class="btn btn-sm btn-secondary">
                                        <a href = "mailto: {{ $item->user->email }}" style="color: white">{{__('site.email')}}</a>
                                    </button>


                                <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                <form class="d-inline" action="{{ route('complaint.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>



                                </td>

                             @endforeach

                            </tbody>

                        </table>
                       <div class="" style="padding: 10px">
                        {{ $complaints->links() }}
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
