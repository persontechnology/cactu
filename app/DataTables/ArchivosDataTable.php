<?php

namespace cactu\DataTables;

use cactu\Models\Archivo;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class ArchivosDataTable extends DataTable
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
                $archivo=Archivo::find($ar->archivo_id);
                return $archivo->created_at;
            })
            ->editColumn('updated_at',function($ar){
                $archivo=Archivo::find($ar->archivo_id);
                // return $ar->users_m()->count();
                return view('archivos.users',['ar'=>$archivo])->render();
            })
            ->addColumn('action', function($ar){
                return view('archivos.archivo',['ar'=>$ar])->render();
                //return view('archivos.accion',['ar'=>$ar])->render();
            })
            ->rawColumns(['action','updated_at']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\Archivo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Archivo $model)
    {
        $user=Auth::user();
        $model=$user->archivos_m();
        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('archivos-table')
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
        return 'Archivos_' . date('YmdHis');
    }
}
