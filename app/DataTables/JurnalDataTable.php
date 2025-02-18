<?php

namespace App\DataTables;

use App\Models\Jurnal;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JurnalDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', 'jurnal.action')
            ->addColumn('action', function($query){
                $editBtn = "
                            <a href='' class='btn btn-primary'><i class='bx bx-pencil'></i></a>
                            ";
                $deletetBtn = "
                            <a href='' class='btn btn-danger ml-2 delete-item'><i class='bx bx-trash'></i></a>
                            ";
                
                return $editBtn.$deletetBtn;
            })
            ->addColumn('siswa_id', function($query){
                $siswa_id = $query->peserta_didik->name;
                return $siswa_id;
            })

            ->addColumn('kehadiran', function($query){
                if($query->kehadiran == 1){
                    $kehadiran = "
                            <span class='badge bg-success'>Hadir</span>
                        ";
                }else if($query->kehadiran == 2){
                    $kehadiran = "
                             <span class='badge bg-warning'>Sakit</span>
                        ";
                }else if($query->kehadiran == 3){
                    $kehadiran = "
                             <span class='badge bg-warning'>Izin</span>
                        ";
                }else{
                    $kehadiran = "
                    <span class='badge bg-danger'>Alfa</span>
                        ";
                }

                return $kehadiran;   
            })
            ->rawColumns(['kehadiran', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Jurnal $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('jurnal-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // Button::make('csv'),
                        // Button::make('pdf'),
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::computed('action')
            Column::make('id')
                ->width(10)
                ->addClass('text-center'),
            Column::make('siswa_id')
                ->width(40),
            Column::make('kehadiran'),
            Column::make('jadwal_id'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('action')
                  ->exportable(true)
                  ->printable(true)
                //   ->width(20)
                  ->addClass('text-center'),
            // Column::make('id'),
            // Column::make('siswa_id'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Jurnal_' . date('YmdHis');
    }
}
