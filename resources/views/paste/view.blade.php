@extends('layouts.home')

@section('title', $title)

@section('style')
  @if ($syntax != false)
    <link rel="stylesheet" href="{{ asset('vendor/prismjs/prism.css') }}">

  @else
    <style>
      pre {
        color: #000;
        word-break: normal;
      }
    </style>
  @endif
@endsection


@section('script')
@if ($syntax != false)
  <script src="{{ asset('vendor/prismjs/prism.js') }}"></script>
@endif
@endsection


@section('content')
<div class="container-fluid py-paste">
<div class="container">
  @if ($expiration == "Expired")
    <div class="alert alert-info" role="alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i>This paste has expired, however since you've wrote it you may view it whenever you want.</i>
    </div>
  @elseif ($expiration == "Burn after reading (next time)")
    <div class="alert alert-warning" role="alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i>This paste is in burn after reading. From now, it could be viewed only one time.</i>
    </div>
  @elseif ($expiration == "Burn after reading")
    <div class="alert alert-danger" role="alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <i><strong>Be careful!</strong> This paste is in burn after reading mode and you won't be able to see it again.</i>
    </div>
  @endif
    <div class="row">
      <div class="col-sm-12">
        <h3 style="margin-top:0px; word-wrap: break-word;">{{ $title }}</h3>
      </div>
    </div>

  <div class="row">
    <div class="col-11">
      <ul class="list-inline">

        <script>
          $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })
        </script>

        <li class="list-inline-item">
          <i class="fa fa-user" data-toggle="tooltip" data-placement="bottom" title="Username"></i>
          <i>{{ $username }}</i>
        </li>
        <li class="list-inline-item">
          <i class="far fa-calendar-alt" data-toggle="tooltip" data-placement="bottom" title="Date of creation"></i>
          <i data-toggle="tooltip" data-placement="bottom" title="{{ $fulldate }}">{{ $date }}</i>
        </li>
        <li class="list-inline-item">
          <i class="fa fa-eye" data-toggle="tooltip" data-placement="bottom" title="Times viewed"></i>
          <i>{{ $views }} view(s)</i>
        </li>

        {{-- Kedaluwarsa tersembunyi jika xs --}}
        @if ($expiration == "Never")
          <li class="list-inline-item .d-none .d-sm-block"><i class="far fa-clock" data-toggle="tooltip" data-placement="bottom" title="Expiration"></i> <i>{{ $expiration }}</i></li>
        @else
          <li class="list-inline-item .d-none .d-sm-block"><i class="fa fa-clock" data-toggle="tooltip" data-placement="bottom" title="Expiration"></i> <i>{{ $expiration }}</i></li>
        @endif

        {{-- Privasi tersembunyi jika xs --}}
        @if ($privacy == "Public")
          <li class="list-inline-item .d-none .d-sm-block"><i class="fas fa-lock-open" data-toggle="tooltip" data-placement="bottom" title="Privacy"></i> <i>{{ $privacy }}</i></li>
        @else
          <li class="list-inline-item .d-none .d-sm-block"><i class="fa fa-lock" data-toggle="tooltip" data-placement="bottom" title="Privacy"></i> <i>{{ $privacy }}</i></li>
        @endif
      </ul>
    </div>
    @if ($sameUser == true)
      <div class="col-md-1">
        <button class="btn btn-danger btn-sm float-right" type="button" data-toggle="modal" data-target="#delete" aria-expanded="false" aria-controls="collapse}"><i class="fa fa-trash-alt"></i></button>
      </div>
      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="preview" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="preview" style="word-wrap: break-word;">Delete "<i>{{ $title }}</i>" ?</h4> <br>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">Are you sure ? <br> This will <b>permanently</b> remove the paste you created !</div>
            <div class="modal-footer">
              <a class="btn btn-danger btn-sm" href="{{ route('userDelPaste', $link) }}" role="button">Yes</a>
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>

  {{-- Hanya diformat jika SH diaktifkan --}}
  <div class="row" @if ($syntax != false) style="margin-bottom:20px;" @endif>
    <div class="col">
      <div class="syntax py-card rounded">
        <div class="code-header">
          <label for="paste">
            @if ($syntax != 'Text')
              <div class="py-badge">{{$syntax}}</div> ({{ $getPasteSize }} KB) @else <b>Plain-text</b> ({{ $getPasteSize }} KB)
            @endif
          </label>

          <div class="code-header-button float-right">
            <div class="py-badge"><a href="{{ route('pasteRaw', $link) }}">raw</a></div>
            <div class="py-badge"><a href="{{ route('pasteDownload', $link) }}">download</a></div>
          </div>
        </div>

        <pre id="paste"><code class="line-numbers lang-{{ $syntax }}">@if ($syntax == false) <i> @endif {{ $content }} @if ($syntax == false) </i> @endif</code></pre>
      </div>
    </div>
  </div>

  {{-- Hanya muncul jika SH diaktifkan --}}
  {{-- @if ($syntax != 'Text')
    <div class="row" style="margin-bottom:20px;">
      <div class="col">
        <div class="plain-text">
          <div class="code-header"><label for="noFormatPaste"><i><b>Plain-text</b></i></label></div>
          <textarea class="form-control input-sm" id="noFormatPaste" readonly="true">{{ $content }}</textarea>
        </div>
      </div>
    </div>
  @endif --}}
</div> {{-- .container --}}
</div> {{-- .container-fluid --}}
@endsection
