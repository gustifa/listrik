@extends('guru.guru_dashboard')
@section('guru')

@section('title')
   Jadwal Pelajaran
@endsection

<div class="page-content">
   @foreach($tes as $key => $item)
   <input type="text" value="{{$item}}">
   @endforeach
</div>
@endsection