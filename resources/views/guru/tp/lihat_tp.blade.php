@extends('guru.guru_dashboard')
@section('guru')

@section('title')
   Lihat TP
@endsection

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
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
        <a href="{{route('tambah.tp.guru')}}" class="btn btn-primary">Tambah TP</a>
    </div>
    <div class="card">
        <div class="card-body">
           
                {{ $dataTable->table() }}
           
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
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

