@extends('admin.admin_dashboard')
@section('admin')
@section('title')
   Tambah Kelas
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Waktu Pelajaran</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('all.category')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Waktu</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="mx-auto col-xl-12">

            {{-- <h6 class="mb-0 text-uppercase">Add Category</h6> --}}
            <hr/>
            <div class="card">
                <div class="card-body">
                    <form id="myForm" method="post" action="{{route('simpan.waktu')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 form-group">
                            <label class="form-label">Jam Ke:</label>
                            <input type="number" class="form-control" name="nama">
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">Tanggal Mulai:</label>
                            <input type="time" class="form-control" name="waktu_mulai">
                        </div>

                      

                        <div class="mb-3 form-group">
                            <label class="form-label">Tanggal Selesai:</label>
                            <input type="time" class="form-control" name="waktu_selesai">
                        </div>
                        <div class="mb-3">
                            
                            <button type="submit" class="px-5 btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <!--end row-->
</div>
@endsection
