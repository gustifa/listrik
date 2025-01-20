@extends('admin.admin_dashboard')
@section('admin')

@section('title')
   Data Kehadiran
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
        <div class="breadcrumb-title pe-3">Kehadiran</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kehadiran</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="mb-3">
        <a href="{{route('tambah.kehadiran')}}" class="btn btn-primary"><i class="lni lni-plus"></i></a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5px;">No</th>
                            <th>Nama Kehadiran</th>
                            <th>Status</th>
                            <th style="width: 20px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kehadiran as $key=> $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->nama_kehadiran}}</td>
                            <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input large-chexbox status-toggle" type="checkbox" role="switch" id="flexSwitchCheckDefault1" data-kehadiran="{{$item->id}}" {{$item->status ? 'checked' : ''}} >
                                        <label class="form-check-label" for="flexSwitchCheckDefault1"></label>
                                      </div>
                            </td>
                            <td>
                                <a href="{{route('edit.kehadiran',$item->id)}}" class="btn btn-info" title="Edit"><i class="lni lni-pencil"></i></a>
                                <a href="{{route('hapus.kehadiran',$item->id)}}" id="delete"  class="btn btn-danger" title="delete"><i class="lni lni-trash"></i></a>
                            </td>
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
            var kehadiranId = $(this).data('kehadiran');
            var isChecked = $(this).is(':checked');

            // send an ajax request to update status

            $.ajax({
                url: "{{ route('update.kehadiran.status') }}",
                method: "POST",
                data: {
                    kehadiran : kehadiranId,
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
