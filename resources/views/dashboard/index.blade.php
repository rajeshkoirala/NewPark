{{--{{Auth::user()->username}}--}}
@if(Session::has('message'))
  {{ Session::get('message') }}
@endif