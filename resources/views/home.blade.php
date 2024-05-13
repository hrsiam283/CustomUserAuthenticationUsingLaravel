@extends('master')
@section('title','Home')
@section('content')
@if(Session::has('msg')){
<p class="alert alert-success">{{ Session::get('msg') }}</p>
}
@endif
@endsection