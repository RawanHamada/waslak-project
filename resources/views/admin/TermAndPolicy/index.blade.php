@extends('layout.dashboard')

@section('content')
    <!-- Rounded Ribbon -->
    <div class="page-content">

        <div class="container-fluid">
            <!-- Right Ribbon -->
            @foreach ($terms as $term)
                <div class="card ribbon-box border shadow-none right mb-lg-0" >
                    <div style="padding-bottom: 35px" class="card-body">


                        {{--                        <div class="ribbon ribbon-info round-shape"><a href="{{route('terms.destroy',$term->id)}}">{{__('site.edite')}}</a> --}}


                        {{--                            <form class="d-inline" action="{{route('terms.destroy',$term->id)}}" method="post"> --}}
                        {{--                                @csrf --}}
                        {{--                                @method('delete') --}}
                        {{--                                --}}{{-- <button onclick="return confirm('Are you sure اخوي ؟')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button> --}}
                        {{--                            </form> --}}
                        {{--                        </div> --}}


                        <button style="margin-top: 10px;background-color: #d27171;border: none" class="ribbon ribbon-info round-shape btn-delete">Delete</button>

                        <form  action="{{ route('terms.destroy', $term->id) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        {{-- <div class="card-body"> --}}
{{--                            <form  action="{{ route('terms.edite', $term->id) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                @method('put')--}}
{{--                                    Update--}}
{{--                                </button>--}}
{{--                            </form>--}}
                        <button style="margin-top: 55px; background-color:  #0ab39c; border: none" class="ribbon ribbon-info round-shape">

                                                    <a style="color: whitesmoke" href="{{ route('terms.edite', $term->id) }}">Edit</a>

                        </button>

                        {{-- </div> --}}


                        @if (app()->currentLocale() == 'ar')
                            <h5 class="fs-14 text-start">{{ $term->title_ar }}</h5>
                            <div class="ribbon-content mt-4 text-muted">
                                <p class="mb-0">{{ $term->description_ar }}</p>
                            </div>
                        @else
                            <h5 class="fs-14 text-start">{{ $term->title_en }}</h5>
                            <div class="ribbon-content mt-4 text-muted">
                                <p class="mb-0">{{ $term->description_en }}</p>
                            </div>
                        @endif

                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection




