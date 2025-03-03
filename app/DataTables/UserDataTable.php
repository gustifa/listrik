<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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

        ->addColumn('status', function($query){
            if($query->status == 1){
                $status = "
                <div class='form-check form-switch'>

                <input class='form-check-input large-chexbox status-toggle' type='checkbox' role='switch' id='flexSwitchCheckDefault1' data-user='$query->id'checked >
                </div>
                ";
                return $status;
            }else{
                $status = "
                <div class='form-check form-switch'>

                <input class='form-check-input large-chexbox status-toggle' type='checkbox' role='switch' id='flexSwitchCheckDefault1' data-user='$query->id'>
                </div>
                ";
                return $status; 
            }
            
        })
        ->rawColumns(['action', 'status'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('excel')->addClass('btn btn-sm'),
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

            //Column::make('id'),
            //Column::make('add your columns'),
            Column::make('name'),
            Column::make('status'),
            Column::make('updated_at'),
            Column::computed('action')
            // ->exportable(false)
            // ->printable(false)
            // ->width(60)
            // ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
