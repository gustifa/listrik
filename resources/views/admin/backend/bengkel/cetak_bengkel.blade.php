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


<table id="judul">
  <tr>
    <td>
      <h2>
        <img id ="showImage"src="">

      </h2>
    </td>
    <td align="center">
      <h3>
        DINAS PROVINSI SUMATERA BARAT
      </h3>
      <h2>
        SMK NEGERI BUKITTINGGI
      </h2>
      <p>Jl. Teuku Umar KM. 1 Kecamatan Kinali Kabupaten Pasaman Barat</p>
      <!-- <p>Phone : 343434343434, Email : support@easylerningbd.com</p> -->

    </td>
    <td>
      <h2>
        <img id ="showImageProvinsi"src="">

      </h2>
    </td>
  </tr>
</table>
<hr />

@php

@endphp
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
<script type="text/javascript">
  window.print();
</script>
</html>
