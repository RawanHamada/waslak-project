@extends('errors.layout')


@section('image')

 <img src="{{ asset('adminassets/images/error.svg') }}" alt="" class="error-basic-img move-animation">

@endsection

@section('error','404')
@section('title','Sorry, Page not Found 😭')


@section('description','The page you are looking for not available!')

