<?php

namespace App\Imports;

use App\Models\Bengkel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BengkelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Bengkel([
            'nama_bengkel'     => $row['nama_bengkel'],
            'kode_bengkel'     => $row['kode_bengkel'],
            'keterangan'     => $row['keterangan'],
        ]);
    }
}
