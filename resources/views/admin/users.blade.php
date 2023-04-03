@extends('layout.dashboard')



@section('content')
<!-- Striped Rows -->
<div class="page-content">
 <div class="container-fluid">
    <form action="{{ route('admin.users') }}" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="{{ __('site.search_here') }}" name="search" value="{{ request()->search }}">
            <button class="btn btn-dark px-5" id="button-addon2">{{ __('site.search') }}</button>
          </div>
    </form>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ __('site.all_users ') }}</h4>


            </div><!-- end card header -->

            <div class="card-body">
                <p class="text-muted mb-4">{{ __('site.All users in app') }}</p>

                <div class="live-preview">
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap table-striped-columns mb-0">
                            <thead class="table-light">
                                <tr>

                                    <th scope="col">{{ __('site.id') }}</th>
                                    <th scope="col">{{ __('site.name') }}</th>
                                    <th scope="col">{{ __('site.phone') }}</th>
                                    <th scope="col">{{ __('site.email') }}</th>
                                    <th scope="col">{{ __('site.membership') }}</th>
                                    <th scope="col" style="width: 150px;">{{ __('site.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($users as $user)
                             <tr>

                                <td><a href="#" class="fw-medium">{{ $user->id }}</a></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge bg-success">

                                 @if ($user->membership)
                                 {{ $user->membership }}

                                 @else

                                 Unknown

                                 @endif



                                </span></td>


                                <td>

                                <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                                <form class="d-inline" action="{{ route('admins.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    {{-- <button onclick="return confirm('Are you sure اخوي ؟')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> --}}
                                </form>

                                </td>






                             @endforeach

                            </tbody>

                        </table>
                       <div class="" style="padding: 10px">
                        {{ $users->links() }}
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









