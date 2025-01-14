<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak User {{$user->name}}</title>
    <style>
        h1{
            text-align: center;

        }

        #user td, #user th {
            border: 1px solid #ddd;
            padding: 8px;
            }

        #user tr:nth-child(even){background-color: #f2f2f2;}

        #user tr:hover {background-color: #ddd;}

        #user th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        table{
            border-collapse: collapse;
            width: 100%;
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
    <h1>Informasi Akun</h1>
    <table id="user">
        <tr>
            <th>Nama Pengguna</th>
            <th>Email</th>
            <th>Password</th>
            <th>Jenis Pengguna</th>
        </tr>
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>12345678</td>
            <td>
                @if ($user->role == 'siswa')
                    <span class="badge bg-success">Siswa</span>
                @elseif($user->role == 'guru')
                    <span class="badge bg-danger">Guru</span>
                @elseif($user->role == 'wakil')
                    <span class="badge bg-danger">Wakil</span>
                @elseif($user->role == 'admin')
                    <span class="badge bg-danger">Admin</span>
                @endif
            </td>
        </tr>
    </table>
    @php
        $id = Auth::user()->id;
        // dd($id);
        $user = App\Models\User::find($id);
    @endphp
    <i style="font-size: 14px; float: left;">Tanggal Cetak : {{ date("d M Y") }}</i>
    <i style="font-size: 14px; float: right;">dicetak oleh : <a href="http://wa.me/6285274817886">{{$user->name }}</a></i>
</body>
</html>
