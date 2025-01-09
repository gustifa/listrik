<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Bengkel;

class BengkelImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        return new Bengkel([
            'nama_bengkel'     => $row['nama_bengkel'],
            'kode_bengkel'     => $row['kode_bengkel'],
            'keterangan'     => $row['keterangan'],
        ]);
    }
}
