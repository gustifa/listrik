@extends('admin.admin_dashboard')
@section('admin')

@section('title')
   Tambah Program Keahlian
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Program Keahlian</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('all.category')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Program Keahlian</li>
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
                    <form id="myForm" method="post" action="{{route('simpan.proka')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 form-group">
                            <label class="form-label">Nama Jurusan:</label>
                            <input type="text" class="form-control" name="nama_proka">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">Kode Jurusan:</label>
                            <input type="text" class="form-control" name="kode_proka">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">Ka. Proka:</label>
                            <select name="ka_proka_id" class="form-select select2-hidden-accessible" id="single-select-field" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                <option disabled data-select2-id="select2-data-2-747t">Pilih Ka. Proka</option>
                                @foreach ($user as $item )
                                <option data-select2-id="select2-data-77-kb3z" value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach


                            </select>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">Input File:</label>
                            <input type="file" class="form-control" name="logo_proka" id="image">

                        </div>
                        <div class="mb-3">
                            <img id ="showImage"src="{{(!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo): url('upload/no_image.jpg')}}" alt="Admin" class="p-1 rounded-circle bg-primary" width="150">
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

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                nama_proka: {
                    required : true,
                },
                kode_proka: {
                    required : true,
                },

                user_id: {
                    required : true,
                },

                logo_proka: {
                    required : true,
                },

            },
            messages :{
                nama_proka: {
                    required : 'Nama Proka Tidak Boleh Kosong',
                },
                kode_proka: {
                    required : 'Kode Proka Tidak Boleh Kosong',
                },

                user_id: {
                    required : 'Proka Tidak Boleh Kosong',
                },

                logo_proka: {
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
