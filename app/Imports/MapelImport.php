<?php

namespace App\Imports;

use App\Models\Mapel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MapelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mapel([
                'nama_mapel'     => $row['nama_mapel'],
                'kode_mapel'     => $row['kode_mapel'],
                'keterangan'     => $row['keterangan'],
        ]);
    }

    // public function rules(): array
    // {
    //     return [
    //         'name' => 'required',
    //         'password' => 'required|min:5',
    //         'email' => 'required|nama_mapel|kode_mapel|unique:mapels'
    //     ];
    // }
}
