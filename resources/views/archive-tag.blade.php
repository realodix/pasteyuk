@extends('layouts.home')

@section('title', 'Pastes Archive')

@section('content')
<div class="container-fluid py-archive">
<div class="container">
  <div class="row">
    <div class="col">
      <h4>Pastes Archive</h4>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-9 archive-table py-card">
      <table class="table">
        <thead class="thead">
          <tr>
            <th scope="col">Name / Title</th>
            <th scope="col">Posted</th>
            <th scope="col">Syntax</th>
          </tr>
        </thead>
        <tbody>
        @forelse ($pastes as $paste)
        <tr>
          <td><a href="{{ url('/', $paste->link) }}">{{ $paste->title }}</a></td>
          <td>{{ $paste->created_at->diffForHumans() }}</td>
          <td>{{ $paste->pasteSyntax->syntax_name }}</td>
        </tr>
        @empty
          <b>No pastes</b>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="col-3">
      <div class="card bg-light mb-3" style="max-width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Paste is for source code and general debugging text.</h5>
          <p class="card-text">Login or Register to edit, delete and keep track of your pastes and more.</p>
        </div>
      </div>
    </div>
  </div>
</div> {{-- .container --}}
</div> {{-- .container-fluid --}}
@endsection
