@extends('layouts.app')
@section('banner')
<div class="row mb-2">
    <div class="col-12">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active " style="max-height: 60vh">
                <img class="d-block w-100" src="{{ asset('/images/banner3.jpg') }}" alt="First slide">
              </div>
              <div class="carousel-item" style="max-height: 60vh">
                <img class="d-block w-100" src="{{  asset('/images/banner2.jpg')}}" alt="Second slide">
              </div>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-4">
        <a class="btn btn-primary btn-sm btn-block" href="{{route('home')}}">Ir a eventos</a>
    </div>
</div>
@endsection
