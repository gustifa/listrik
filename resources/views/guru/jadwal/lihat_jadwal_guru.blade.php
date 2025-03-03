@extends('guru.guru_dashboard')
@section('guru')

@section('title')
   Jadwal Pelajaran
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    .large-chexbox{
        transform: scale(1.5);
        /* margin-left: 2em; */
    }
</style>
<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Jadwal Pelajaran</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('guru.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Jadwal Pelajaran</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="mb-3">
        <a href="{{route('tambah.jadwal.guru')}}" class="btn btn-primary">Tambah Jadwal</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5px;">No</th>
                            {{-- <th>Nama Guru</th> --}}
                            <th>Hari</th>
                            <th>Mata Pelajaran</th>
                            <th>Rombel</th>
                            <th>Bengkel</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            {{-- <th style="width: 20px;">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>

                            {{-- <td>{{$item['user']['name']}}</td> --}}
                            <td>{{$item['hari']['nama_hari']}}</td>
                            <td>{{$item['mapel']['kode_mapel']}}</td>
                            <td>{{$item['rombel']['nama_rombel']}}</td>
                            <td>{{$item['bengkel']['nama_bengkel']}}</td>
                            <td>{{$item['waktu_mulai']['waktu_mulai']}}</td>
                            <td>{{$item['waktu_selesai']['waktu_selesai']}}</td>
                            <td> @if ($item->status == 1)
                                <span class="btn btn-success">Aktif </span>
                                @else
                                <span class="btn btn-danger">Tidak Aktif </span>
                                @endif
                            </td>
                            {{-- <td> --}}
                                {{-- <a href="{{route('edit.jadwal',$item->id)}}" class="btn btn-info" title="Edit"><i class="lni lni-eraser"></i></a> --}}
                                {{-- <!-- <a href="{{route('delete.jadwal',$item->id)}}" id="delete" class="btn btn-danger" id="delete" title="delete"><i class="lni lni-trash"></i></a> --> --}}
                            {{-- </td> --}}
                        </tr>
                        @endforeach


                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('.status-toggle').on('change', function(){
            var jadwalId = $(this).data('jadwal');
            var isChecked = $(this).is(':checked');

            // send an ajax request to update status

            $.ajax({
                url: "{{ route('update.jadwal.status') }}",
                method: "POST",
                data: {
                    jadwal : jadwalId,
                    is_checked: isChecked ? 1 : 0,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    toastr.success(response.message);
                },
                error: function(){

                }
            });

        });
    });

</script>
@endsection
