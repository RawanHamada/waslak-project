@extends('errors.layout')


@section('image')

 <img src="{{ asset('adminassets/images/error.svg') }}" alt="" class="error-basic-img move-animation">

@endsection

@section('error','500')
@section('title','Internal Server Error!')


@section('description','Server Error 500. We\'re not exactly sure what happened, but our servers say something is wrong.')

