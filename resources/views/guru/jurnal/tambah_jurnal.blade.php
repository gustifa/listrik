@extends('guru.guru_dashboard')
@section('guru')

@section('title')
   Tambah Jurnal
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
                    <li class="breadcrumb-item active" aria-current="page">Tambah Jurnal</li>
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
                    <form id="myForm" method="post" action="{{route('simpan.jurnal.guru')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 form-group">
                            <label class="form-label">Jurnal Pembelajaran:</label>
                            <input type="text" class="form-control" name="nama_bengkel">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">Nama Hari:</label>
                            <select name="mulai_id" class="form-select select2-hidden-accessible" id="single-select-field" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                <option disabled data-select2-id="select2-data-2-747t">Pilih Nama Mapel</option>
                                @foreach ($jadwal as $item )
                                <option data-select2-id="select2-data-77-kb3z" value="{{$item->id}}">{{$item['hari']['nama_hari']. ' Mata Pelajaran '.$item['mapel']['nama_mapel']. ' <=> '.$item['waktu_mulai']['waktu_mulai']. ' s/d '.$item['waktu_selesai']['waktu_selesai']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">Siswa Hadir:</label>
                            <select name="mulai_id" class="form-select select2-hidden-accessible" id="single-select-field" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                <option disabled data-select2-id="select2-data-2-747t">Pilih Nama Mapel</option>
                                @foreach ($jadwal as $item )
                                <option data-select2-id="select2-data-77-kb3z" value="{{$item->id}}">{{$item['mapel']['nama_mapel']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">Kode Bengkel:</label>
                            <input type="text" class="form-control" name="kode_bengkel">
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">Keterangan:</label>
                            <input type="text" class="form-control" name="keterangan">
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
                category_name: {
                    required : true,
                },

                image: {
                    required : true,
                },

            },
            messages :{
                category_name: {
                    required : 'Please Enter Category Name',
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

<script type="text/javascript">

    $(document).ready(function(){
        $('select[name="_id"]').on('change', function(){
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="subcategory_id"]').html('');
                        var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },

                });
            } else {
                alert('danger');
            }
        });
    });

</script>
@endsection
