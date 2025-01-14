<!DOCTYPE html>
<html>
<head>
<style>
h2{
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
}
#judul {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;

}

#judul td, #judul th {
  border: 0px solid #ddd;
  padding: 1px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

hr {
  border-top: 1px solid #000 ;
  border-bottom: 3px solid #000 ;
  margin: 0;
  padding: ;
}
</style>
</head>

<body>
@php
    $sekolah = App\Models\Sekolah::find(1);
    //dd($sekolah->logo_sekolah);
@endphp

<table id="judul">
  <tr>
    <td>
      <h2>
        <img id ="showImage"src="{{$sekolah->logo_sekolah}}" width="100">

      </h2>
    </td>
    <td align="center">
      <h3>
        DINAS PROVINSI {{strtoupper($sekolah->provinsi)}}
      </h3>
      <h2>
        {{$sekolah->nama}}
      </h2>
      <p>{{$sekolah->alamat}}</p>
      <!-- <p>Phone : 343434343434, Email : support@easylerningbd.com</p> -->

    </td>
    <td>
      <h2>
        <img id ="showImageProvinsi"src="{{$sekolah->logo_provinsi}}" width="100">

      </h2>
    </td>
  </tr>
</table>
<hr />


<h2 align="center">Laporan Bengkel</h2>


<table id="customers">
  <tr>
    <th width="5%">No</th>

    <th width="35%">Nama Bengkel</th>
    <th width="35%">Kode Bengkel</th>
    <th width="35%">Keterangan</th>
  </tr>
  @foreach($bengkel as $key => $item)
  <tr>
    <td>{{$key+1}}</td>

    <td>{{$item->nama_bengkel}}</td>
    <td>{{$item->kode_bengkel}}</td>
    <td>{{$item->keterangan}}</td>

  @endforeach


</table>
<br> <br>
  <i style="font-size: 14px; float: right;">Tanggal Cetak : {{ date("d M Y") }}</i>


</body>
{{-- <script type="text/javascript">
  window.print();
</script> --}}
</html>
