@extends('layouts.home')

@section('title', $title)

@section('content')
<div class="container-fluid py-paste-password">
<div class="container">
  <h2 class="text-center display-4">Password prompt</h2>
  <div class="row" style="margin-top:25px;">

  <form class="form-row mx-auto" action="{{ $link }}" method="post" accept-charset="utf-8">
  @csrf
    <div class="col-md" id="passwordInput">
      <input type="password" class="form-control @if (isset($wrongPassword)) is-invalid @endif" name="pastePassword" id="pastePassword" placeholder="Enter paste password" maxlength="40" autofocus="true" required>
    </div>
    <button type="submit" id="submit" class="btn @if (isset($wrongPassword)) btn-danger @else btn-outline-success @endif">Submit</button>
  </form>
  </div>
</div> {{-- .container --}}
</div> {{-- .container-fluid --}}
@endsection
