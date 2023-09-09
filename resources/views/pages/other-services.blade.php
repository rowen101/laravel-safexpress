@extends('layouts.safexpress')
@section('content')
<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs d-flex align-items-center" style="background-image: url('img/about-header.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center">

        <h2>{{$title}}</h2>
        <ol>
          <li><a href="/">Home</a></li>
          <li>{{$title}}</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->


@endsection

