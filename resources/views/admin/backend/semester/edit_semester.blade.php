@extends('admin.admin_dashboard')
@section('admin')
@section('title')
   Edit Semester
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Semester</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('semua.semester')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Semester</li>
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
                    <form id="myForm" method="post" action="{{route('update.semester')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$semester->id}}">
                        <div class="mb-3 form-group">
                            <label class="form-label">Semester:</label>
                            <input type="text" class="form-control" name="nama" value="{{$semester->nama}}">
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
