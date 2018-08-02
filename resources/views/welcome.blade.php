@extends('layouts.home')

@section('title', 'Home')

@section('content')
<div class="container-fluid py-home">
<div class="container">
  <div class="row">
    <div class="col-md-9">
     <form action="{{ url('/create') }}" method="post" accept-charset="utf-8">
       @csrf
        <div class="form-row align-items-center">
          <div class="col-auto">
            @if ($errors->has('pasteTitle'))
              <div class="alert alert-warning" role="alert">{{ $errors->first('pasteTitle') }}</div>
            @endif
            @if ($errors->has('pasteContent'))
              <div class="alert alert-warning" role="alert">{{ $errors->first('pasteContent') }}</div>
            @endif
            <label class="sr-only" for="inlineFormInputGroup" name>Name / Title (optional)</label>
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text">A</div>
              </div>
              <input type="text" name="pasteTitle" class="form-control" id="inlineFormInputGroup" placeholder="Paste Name / Title">
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="pasteContent" class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            @include('paste.syntaxhighlighting')
          </div>
          <div class="form-group col-md-3">
            <label for="expire">Paste Expiration</label>
            <select class="form-control" name="expire" id="expire">
              <option value="never" selected="selected">Never</option>
              <option value="burn">Burn after reading</option>
              <option value="10m">10 minutes</option>
              <option value="1h">1 hour</option>
              <option value="1d">1 day</option>
              <option value="1w">1 week</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="privacy">Privacy</label>
            <select class="form-control @if ($errors->has('pastePassword')) is-invalid @endif" name="privacy" id="privacy" onchange='checkvalue(this.value)'>
              <option value="0">Public</option>
              <option value="link">Unlisted</option>
              <option value="password" @if ($errors->has('pastePassword')) selected="selected" @endif>password-protected</option>
              @guest
                <option value="" disabled="disabled">Private (members only)</option>
              @endguest
              @auth
                <option value="private">Private, only me</option>
              @endauth
            </select>
          </div>
          <div class="form-group col-md-3" id="passwordInput" @if (!$errors->has('pastePassword')) style="display:none;" @endif>
            <label for="pastePassword">Password</label>
            <input type="password" class="form-control @if ($errors->has('pastePassword')) is-invalid @endif" name="pastePassword" id="pastePassword" placeholder="Enter a password..." maxlength="40">
            @if ($errors->has('pastePassword'))
              <div class="invalid-feedback">
                {{ $errors->first('pastePassword') }}
              </div>
            @endif
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Create New Paste</button>
      </form>
    </div>

    <div class="col-md-3">
      <div class="card mb-3" style="max-width: 18rem;">
        <div class="card-header">Demo User Account</div>
        <div class="card-body">
          <b>Username</b>
          <div class="font-weight-light">admin / admin@admin.com</div>
          <br>
          <b>Password</b>
          <div class="font-weight-light">password</div>
        </div>
      </div>

      <div class="card" style="max-width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Paste is for source code and general debugging text.</h5>
          <p class="card-text">Login or Register to edit, delete and keep track of your pastes and more.</p>
        </div>
      </div>
    </div>
  </div>
</div> {{-- .container --}}
</div> {{-- .container-fluid --}}

<script>
function checkvalue(value) {
  if(value==="password")
    document.getElementById('passwordInput').style.display='block';
  else
    document.getElementById('passwordInput').style.display='none';
}
</script>
@endsection
