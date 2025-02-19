@extends('guru.guru_dashboard')
@section('guru')

@section('title')
   Tambah Tujuan Pembelajaran
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Bengkel</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('lihat.jurnal.guru')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah TP</li>
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
                    <form id="myForm" method="post" action="{{route('update.tp.guru')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$tp->id}}" name="id">
                        <div class="mb-3 form-group">
                            <label class="form-label">Mata Pelajaran:</label>
                            <select name="mapel_id" class="form-select select2-hidden-accessible" id="single-select-field" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                <option disabled data-select2-id="select2-data-2-747t">Pilih Nama Mapel</option>
                                @foreach ($mapel as $item )
                                <option data-select2-id="select2-data-77-kb3z" value="{{$item->id}}">{{$item->nama_mapel}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">Tujuan Pembelajaran:</label>
                            <input type="text" class="form-control" name="nama" value="{{$tp->nama}}">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">Keterangan:</label>
                            <input type="text" class="form-control" name="keterangan" value="{{$tp->keterangan}}">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="px-5 btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    
    <!--end row-->
</div>

@endsection
