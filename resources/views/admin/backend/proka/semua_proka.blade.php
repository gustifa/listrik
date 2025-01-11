@extends('admin.admin_dashboard')
@section('admin')

@section('title')
   Data Group
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Kelas</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
                </ol>
            </nav>
        </div>
        
    </div>
    <!--end breadcrumb-->
    <div class="mb-3">
        <a href="{{route('tambah.proka')}}" class="btn btn-primary">Tambah Proka</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5px;">No</th>
                            <th>Logo Proka</th>
                            <th>Nama Proka</th>
                            <th>Kode Proka</th>
                            <th>Ka. Proka</th>
                            <th style="width: 20px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proka as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <!-- <img src="{{asset($item->logo_sekolah)}}" alt="" style="height: 70px" width="70px" > -->
                                <img src="{{(!empty($item->logo_proka)) ? url($item->logo_proka): url('upload/no_image.jpg')}}" alt="logo_proka" width="50" class="p-1 rounded-circle bg-primary">
                            </td>
                            
                            <td>{{$item->kode_proka}}</td>
                            <td>{{$item->kode_proka}}</td>
                            <td>{{$item['proka']['name']}}</td>
                            <td>
                                <a href="{{route('edit.group',$item->id)}}" class="btn btn-info" title="Edit"><i class="lni lni-eraser"></i></a>
                                {{-- <!-- <a href="{{route('delete.kelas',$item->id)}}" id="delete" class="btn btn-danger" id="delete" title="delete"><i class="lni lni-trash"></i></a> --> --}}
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
