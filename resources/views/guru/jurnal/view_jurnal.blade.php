@extends('guru.guru_dashboard')
@section('guru')

@section('title')
   Jadwal Pelajaran
@endsection

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<style>
    .large-chexbox{
        transform: scale(1.5);
        /* margin-left: 2em; */
    }
</style>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Jadwal Pelajaran</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('guru.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Jadwal Pelajaran</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <!--end breadcrumb-->
    <div class="mb-3">
        <a href="{{route('semua.tp.guru')}}" class="btn btn-primary">Back</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5px;">No</th>
                            <th>Nama Pengguna</th>
                            <th>Kehadiran</th>
                            <th>dibuat</th>
                            <th>diperbaharui</th>
                            <th>Aksi</th>
                            
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurnal as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->peserta_didik->name}}</td>
                            <td>
                            @if($item->kehadiran == 1)
                            <span class='badge bg-success'>Hadir</span>
                            @elseif($item->kehadiran == 2)

                             <span class='badge bg-warning'>Sakit</span>
                            @elseif($item->kehadiran == 3)
                             <span class='badge bg-warning'>Izin</span>
                            @else
                            <span class='badge bg-danger'>Alfa</span>

                            @endif
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>
                            
                                <a href="" class="btn btn-info" title="Edit"><i class="bx bx-edit"></i></a>
                        
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>



@endsection

