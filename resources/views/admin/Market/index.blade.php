@extends('layout.dashboard')

@section('content')
<!-- Rounded Ribbon -->
<div class="page-content">
  <div class="container-fluid">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{__('site.all_markets')}}</h4>


            </div><!-- end card header -->

            <div class="card-body">
                <p class="text-muted mb-4">{{__('site.all_markets_from_customers')}}</p>

                <div class="live-preview">
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap table-striped-columns mb-0">
                            <thead class="table-light">
                                <tr>

                                    <th scope="col">{{__('site.id')}}</th>
                                    <th scope="col">{{__('site.image')}}</th>
                                    <th scope="col">{{__('site.market_name')}}</th>
                                    <th scope="col">{{__('site.description')}}</th>
                                    <th scope="col">{{__('site.created_at')}}</th>
                                    {{-- <th scope="col"></th> --}}
                                    <th scope="col" style="width: 150px;">{{__('site.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($markets as $market)
                             <tr>
                                <td><a href="#" class="fw-medium">{{ $market->id }}</a></td>
                                    <td><img src="{{ asset('uploads/markets/'.$market->image) }} " width="80">

                                <td>{{ $market->name }}</td>
                                </td>
                                <td>{{ $market->description }}</td>
                                <td>{{ $market->created_at->diffForHumans() }}</td>

                                <td>

                                    <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                <form class="d-inline" action="{{ route('market.destroy', $market->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>

                                    <a href="{{ route('market.edite', $market->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>


                                </td>

                             @endforeach
                             </tr>

                            </tbody>

                        </table>
                       <div class="" style="padding: 10px">
                        {{-- {{ $markets->links() }} --}}
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




