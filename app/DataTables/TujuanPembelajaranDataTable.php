<?php

namespace App\DataTables;

use App\Models\TujuanPembelajaran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class TujuanPembelajaranDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){

     
                    $addBtn = "
                            <a href='".route('tambah.jurnal', $query->id)."' class='btn btn-success'><i class='bx bx-plus'></i></a>
                            ";

                $editBtn = "
                            <a href='".route('edit.jurnal.guru', $query->id)."' class='btn btn-primary'><i class='bx bx-pencil'></i></a>
                            ";
                $deletetBtn = "
                            <a href='' id='delete' class='btn btn-danger ml-2 delete-item'><i class='bx bx-trash'></i></a>
                            ";
                $detailBtn = "
                            <a href='".route('view.jurnal', $query->id)."' class='btn btn-warning'><i class='bx bx-detail'></i></a>
                            ";
                
                return $addBtn.$detailBtn.$editBtn.$deletetBtn;
            })

            ->addColumn('User', function($query){

     
                $addBtn = "
                        <i class='bx bx-user'></i>
                        ";

            
            return $addBtn;
        })

            // ->addColumn('no', function($query){
            //     $key = 0;
            //     foreach ($query as $key => $editBtn) {

            //     }
            //     // $editBtn = '1';
            //     return  $editBtn++;
            // })
            ->addColumn('mapel_id', function($query){
                $mapel = $query->mapel->nama_mapel;
                return  $mapel;
            })
            ->rawColumns(['nama', 'action', 'mapel', 'User'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TujuanPembelajaran $model): QueryBuilder
    {
        return $model->orderBy('id')->where('guru_id', Auth::id())->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tujuanpembelajaran-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel'),
                        // // Button::make('csv'),
                        // // Button::make('pdf'),
                        // // Button::make('print'),
                        // // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::make('id')
            // ->exportable(true)
            // ->printable(true)
            //     ->width(10)
            //     ->addClass('text-center'),
            Column::make('User')
            ->exportable(true)
            ->printable(true)
                ->width(10)
                ->addClass('text-center'),
            Column::make('nama')
                ->exportable(false)
                ->printable(false)
                ->width(50),
            Column::make('keterangan')
                ->exportable(true)
                ->printable(true)
                ->width(50),
            Column::make('mapel_id')
                ->exportable(true)
                ->printable(true)
                ->width(50),
            Column::computed('action')
            ->exportable(true)
            ->printable(true)
                  ->width(150)
                  ->addClass('text-center'),

            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'TujuanPembelajaran_' . date('YmdHis');
    }
}
