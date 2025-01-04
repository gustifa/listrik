@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Sekolah</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Sekolah</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="mx-auto col-xl-12">

            <div class="card">
                <div class="p-4 card-body">
                    {{-- <h5 class="mb-4">Vertical Form</h5> --}}
                    <form id="myForm" method="post" action="{{route('update.profile.sekolah')}}" class="row g-3" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{$sekolah->id}}">
                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Nama Sekolah</label>
                            <input type="text" name="nama" class="form-control" id="input1" value="{{$sekolah->nama}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">NPSN</label>
                            <input type="text" name="npsn" class="form-control" id="input1" value="{{$sekolah->npsn}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">NSS</label>
                            <input type="text" name="nss" class="form-control" id="input1" value="{{$sekolah->nss}}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="input1" value="{{$sekolah->alamat}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Website</label>
                            <input type="text" name="website" class="form-control" id="input1" value="{{$sekolah->website}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="input3" class="form-label">Logo Sekolah</label>
                            <input type="file" class="form-control" name="logo_sekolah" id="image"  />
                        </div>
                        <div class="col-md-12">
                            <img id ="showImage"src="{{ asset($sekolah->logo_sekolah)}}" alt="{{$sekolah->logo_sekolah}}" class="p-1 rounded-circle bg-primary" width="150">
                        </div>



                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary">Simpan</button>
                                <!-- {{-- <button type="button" class="px-4 btn btn-light">Reset</button> --}} -->
                            </div>
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
                category_name: {
                    required : true,
                },



            },
            messages :{
                category_name: {
                    required : 'Please Enter category_name',
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
