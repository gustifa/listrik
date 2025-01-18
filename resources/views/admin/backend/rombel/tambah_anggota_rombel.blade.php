@extends('admin.admin_dashboard')
@section('admin')

@section('title')
   Tambah Rombel
@endsection

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Rombel</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('all.category')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Rombel</li>
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
                    <form id="myForm" method="post" action="{{route('simpan.anggota.rombel')}}" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="mb-3 form-group">
                            <label class="form-label">Tingkat:</label>
                            <select name="kelas_id" class="form-select select2-hidden-accessible" id="single-select-field" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                <option disabled data-select2-id="select2-data-2-747t">Pilih Ka. Proka</option>
                                @foreach ($tingkat as $item )
                                <option data-select2-id="select2-data-77-kb3z" value="{{$item->id}}">{{$item->nama_kelas}}</option>
                                @endforeach


                            </select>
                        </div> --}}

                        {{-- <div class="mb-3 form-group ">
                            <label class="form-label">Nama Program Keahlian:</label>
                            <select name="proka_id" class="form-select select2-hidden-accessible" id="single-select-field" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                <option disabled data-select2-id="select2-data-2-747t">Pilih Jurusan</option>
                                @foreach ($proka as $item )
                                <option data-select2-id="select2-data-77-kb3z" value="{{$item->id}}">{{$item->nama_proka}}</option>
                                @endforeach


                            </select>
                        </div> --}}


                        {{-- <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Course Category </label>
                            <select name="category_id" class="mb-3 form-select" aria-label="Default select example">
                                <option selected="" disabled>Open this select menu</option>
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach

                            </select>
                        </div> --}}


                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Course Category </label>
                            <select name="proka_id" class="mb-3 form-select" aria-label="Default select example">
                                <option selected="" disabled>Nama Proka</option>
                                @foreach ($proka as $item )
                                <option value="{{$item->id}}">{{$item->nama_proka}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Nama Jurusan </label>
                            <select name="jurusan_id" class="mb-3 form-select" aria-label="Default select example">
                                <option> </option>

                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Rombel </label>
                            <select name="rombel_id" class="mb-3 form-select" aria-label="Default select example">
                                <option> </option>

                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Course Category </label>
                            <select name="siswa_id" class="mb-3 form-select" aria-label="Default select example">
                                <option selected="" disabled>Pilih Anggota Rombel</option>
                                @foreach ($siswa as $item )
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach

                            </select>
                        </div>


                        <div class="mb-3">
                            <button type="submit" class="px-5 btn btn-primary">Simpan</button>
                        </div>
                    </form>

                    {{-- Awal Modal --}}
        <div class="col">
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Import User</button> --}}
            <a href="" class="btn btn-primary" title="Print Pengguna Siswa" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bx bx-import"></i></a>
            <a href="{{route('cetak.semua.user')}}" class="btn btn-danger" title="Print Pengguna Siswa" target="_blank"><i class="lni lni-printer"></i></a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                                    <form id="myForm" method="post" action="{{route('users.import')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3 form-group">
                                            <label class="form-label">Input File: </label>
                                            <input type="file" class="form-control" name="file" id="file">

                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="px-5 btn btn-primary">Import</button>
                                        </div>
                                        <div class="mb-3">
                                            <a href="{{route('download.template.user')}}">Download Template</a>
                                        </div>

                                    </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            {{-- <button type="submit" class="btn btn-primary">Save changes</button> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- Akhir Modal --}}
                </div>
            </div>


        </div>
    </div>
    <!--end row-->
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="proka_id"]').on('change', function(){
            var proka_id = $(this).val();
            if (proka_id) {
                $.ajax({
                    url: "{{ url('/jurusan/ajax') }}/"+proka_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="jurusan_id"]').html('');
                        var d =$('select[name="jurusan_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="jurusan_id"]').append('<option value="'+ value.id + '">' + value.nama_jurusan + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="jurusan_id"]').on('change', function(){
            var jurusan_id = $(this).val();
            if (jurusan_id) {
                $.ajax({
                    url: "{{ url('/rombel/ajax') }}/"+jurusan_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="rombel_id"]').html('');
                        var d =$('select[name="rombel_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="rombel_id"]').append('<option value="'+ value.id + '">' + value.nama_rombel + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                proka_id: {
                    required : true,
                },
                jurusan_id: {
                    required : true,
                },
                nama_rombel: {
                    required : true,
                },
                walas_id: {
                    required : true,
                },

                image: {
                    required : true,
                },

            },
            messages :{
                proka_id: {
                    required : 'Jurusan Tidak Boleh Kosong',
                },
                jurusan_id: {
                    required : 'Jurusan Tidak Boleh Kosong',
                },

                nama_rombel: {
                    required : 'Nama Rombel Tidak Boleh Kosong',
                },
                walas_id: {
                    required : 'Walas Tidak Boleh Kosong',
                },
                image: {
                    required : 'Please Upload Image',
                },


            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		})

	});

</script>
@endsection