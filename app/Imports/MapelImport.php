<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Mapel;

class MapelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        return new Mapel([
            'nama_mapel'     => $row['nama_mapel'],
            'kode_mapel'     => $row['kode_mapel'],
            'keterangan'     => $row['keterangan'],
        ]);
    }
}
