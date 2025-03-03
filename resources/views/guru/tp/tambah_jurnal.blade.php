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
            <div class="card">
                <div class="card-body">
                    <form id="myForm" method="post" action="{{route('simpan.jurnal.guru')}}" enctype="multipart/form-data">
                        @csrf
                        <input name="tp_id" type="hidden" value="{{$tp->id}}">
                        <div class="mb-3 form-group">
                            <label class="form-label">Tujuan Pembelajaran: </label>
                            <input disabled type="text" class="form-control" name="nama_bengkel" value="{{$tp->nama}}">
                            
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label">Jurnal Pembelajaran:</label>
                            <input type="text" class="form-control" name="nama_bengkel">
                        </div>

                        

                        <div class="mb-3 form-group">
                            <label class="form-label">Nama Hari:</label>
                            <select name="jadwal_id" class="form-select select2-hidden-accessible" id="single-select-field" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                <option disabled data-select2-id="select2-data-2-747t">Pilih Nama Mapel</option>
                                @foreach ($jadwal as $item )
                                <option data-select2-id="select2-data-77-kb3z" value="{{$item->id}}">{{$item['hari']['nama_hari']. ' Mata Pelajaran '.$item['mapel']['nama_mapel']. ' <=> '.$item['waktu_mulai']['waktu_mulai']. ' s/d '.$item['waktu_selesai']['waktu_selesai']}}</option>
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

                        <div class="mb-3 form-group">
                            <label class="form-label">Nama Rombongan Belajar:</label>
                            <select name="rombel_id" class="form-select select2-hidden-accessible" id="rombel_id" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                <option disabled data-select2-id="select2-data-2-747t">Pilih Rombongan Belajar</option>
                                @foreach ($rombel_id as $item )
                                <option data-select2-id="select2-data-77-kb3z" value="{{$item->id}}">{{$item->nama_rombel}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <a id="search" class="btn btn-primary" name="search"> Tampilkan</a>

                            <br>
                            <br>
                            <div class="row d-none" id="roll-generate">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID No</th> -->
                                                <th>Nama Siswa </th>
                                                <th>Kehadiran </th>
                                                
                                             </tr> 				
                                        </thead>
                                        <tbody id="roll-generate-tr">
                                            
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                                
                            </div>
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
    $(document).on('click','#search',function(){
      var rombel_id = $('#rombel_id').val();
       $.ajax({
        url: "{{ route('get.anggota.rombel')}}",
        type: "GET",
        data: {'rombel_id':rombel_id},
        success: function (data) {
          $('#roll-generate').removeClass('d-none');
          var html = '';
          $.each( data, function(key, v){
            html +=
            '<tr>'+
            '<input type="hidden" name="siswa_id[]" value="'+v.siswa_id+'">'+
            '<td>'+v.peserta_didik.name+'</td>'+
            // '<td>'+'<input type="text" name="siswa_id[]" value="'+v.peserta_didik.name+'</td>'+
            // '<td>'+v.student.gender+'</td>'+
            `<td>
                <select name="kehadiran[]" class="form-select select2-hidden-accessible">
                    <option value="1">Hadir</option>
                    <option value="2">Sakit</option>
                    <option value="3">Izin</option>
                    <option value="4">Alfa</option>
                </select>
            </td>`+
            '</tr>';
          });
          html = $('#roll-generate-tr').html(html);
        }
      });
    });
  
</script>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                siswa_id: {
                    required : true,
                },

                image: {
                    required : true,
                },

            },
            messages :{
                siswa_id: {
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
