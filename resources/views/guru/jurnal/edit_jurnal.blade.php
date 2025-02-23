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
                    <form id="myForm" method="post" action="{{route('update.jurnal.guru')}}" enctype="multipart/form-data">
                        @csrf
                       
                    

                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurnal as $item)
                        <tr>
                            
                            <td>{{$item->peserta_didik->name}}</td>
                            <td>
                            <select name="kehadiran[]" class="form-select select2-hidden-accessible">
                            @foreach ($kehadiran as $cat) 
                            <option value="{{ $cat->id }}" {{ $cat->id == $item->kehadiran ? 'selected' : '' }} >{{ $cat->nama_kehadiran }}</option>
                            @endforeach
                            </select>
                            </td>
                            
                        </tr>
                        @endforeach

                    </tbody>

                </table>

                        <div class="mb-3">
                            <button type="submit" class="px-3 btn btn-primary"><i class="bx bx-save"></i>Update</button>
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



@endsection
