@extends('layout.dashboard')

@section('content')
<!-- Rounded Ribbon -->
<div class="page-content">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">{{ __('') }} </h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row">

                                <form action="{{ route('terms.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                      <label class="form-label">{{ __('site.arabic_title') }}</label>
                                      <input type="text" class="form-control @error('title_ar') is-invalid @enderror" name="title_ar"/>

                                      @error('title_ar')
                                      <small class="invalid-feedback">{{ $message }}</small>
                                  @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('site.english_title') }}</label>
                                        <input type="text" class="form-control @error('title_en') is-invalid @enderror" name="title_en"/>
                                        @error('title_en')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <div class="mb-3">
                                            <label  class="form-label">{{__('site.arabic_desc')}}</label>
                                            <textarea class="form-control @error('description_ar') is-invalid @enderror" name="description_ar"  rows="4">
                                            </textarea>
                                            @error('description_ar')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                          </div>
                                      <div class="mb-3">
                                        <label  class="form-label">{{__('site.english_desc')}}</label>
                                        <textarea class="form-control @error('description_en') is-invalid @enderror" name="description_en"  rows="4">
                                        </textarea>
                                        @error('description_en')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                      </div>
                                    <button type="submit" class="btn btn-primary">{{__('site.submit')}}</button>
                                  </form>


                            </div>
                            <!--end row-->
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

@endsection



