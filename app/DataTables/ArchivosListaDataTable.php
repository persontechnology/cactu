<?php

namespace cactu\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use cactu\Models\Archivo;

class ArchivosListaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at',function($ar){
                return $ar->created_at;
            })
            ->editColumn('url',function($ar){
                return view('archivos.archivo',['ar'=>$ar])->render();
            })
            ->editColumn('updated_at',function($ar){
                //return $ar->users_m()->count();
                return view('archivos.users',['ar'=>$ar])->render();
            })
            ->addColumn('action', function($ar){
                return view('archivos.accion',['ar'=>$ar])->render();
            })
            ->rawColumns(['action','updated_at','url']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\ArchivosListum $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Archivo $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('archivoslista-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->title('Acción')
                  ->addClass('text-center'),
            Column::make('nombre')->title('Nombre'),
            Column::make('url')->title('Archivo'),
            Column::make('created_at')->title('Compartido el'),
            Column::make('descripcion')->title('Descripción'),
            Column::make('updated_at')->title('Usuarios')
            ->exportable(false)
            ->searchable(false)
                ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ArchivosLista_' . date('YmdHis');
    }
}
