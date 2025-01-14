<style>
    .sekolah{
            line-height: 10px;
        }
        .garis{
            border: 1.5px solid;
        }
</style>

@php
$sekolah = App\Models\Sekolah::find(1);
//dd($sekolah->logo_sekolah);
@endphp

<table id="judul" class="sekolah">
<tr>
<td>
  <h2>
    <img id ="showImage"src="{{$sekolah->logo_sekolah}}" width="100">

  </h2>
</td>
<td align="center" >
  <h3>
    DINAS PROVINSI {{strtoupper($sekolah->provinsi)}}
  </h3>
  <h2>
    {{$sekolah->nama}}
  </h2>
  <p>{{$sekolah->alamat}}</p>
  <p>Phone: {{$sekolah->no_telp}}, Email: {{$sekolah->email}}, Website: {{$sekolah->website}}, </p>


</td>
<td>
  <h2>
    <img id ="showImageProvinsi"src="{{$sekolah->logo_provinsi}}" width="100">

  </h2>
</td>
</tr>
</table>
<hr class="garis" />
