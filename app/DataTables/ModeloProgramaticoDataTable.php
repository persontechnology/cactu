<?php

namespace cactu\DataTables;

use cactu\Models\ModeloProgramatico;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Storage;
class ModeloProgramaticoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
         return datatables($query)
            ->addColumn('actividades', function($modelo){
                return '<a href="actividades/'.$modelo->id.'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Actividades de '.$modelo->nombre.'"><i class="icon-list-numbered"></i></a>';
            })
            ->addColumn('modulos', function($modelo){
                return '<a href="modulos/'.$modelo->id.'" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Módulos de '.$modelo->nombre.'"><i class="icon-list"></i></a>';
            })
             ->addColumn('action', function($modelo){
                return view('modelosProgramaticos.acciones',['modelo'=>$modelo])->render();
            })
             ->rawColumns(['actividades','modulos','action']);            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\Models\ModeloProgramatico\ModeloProgramatico $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModeloProgramatico $model)
    {
        return $model->newQuery()->select($this->getColumns());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumnsTable())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px','printable' => false, 'exportable' => false,'title'=>'Acciones'])
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
            'id',
            'nombre',
            'codigo'
        ];
    }
       protected function getColumnsTable()
    {
        return [
            'nombre',
            'codigo'=>['title'=>'Código'],
            'actividades'=>['printable'=>false,'exportable'=>false],
            'modulos'=>['printable'=>false,'exportable'=>false,'title'=>'Módulos'],
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ModeloProgramatico_' . date('YmdHis');
    }
}
