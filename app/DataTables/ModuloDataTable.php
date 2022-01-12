<?php

namespace cactu\DataTables;

use Yajra\DataTables\Services\DataTable;
use cactu\Models\Modulo;
use cactu\Models\ModeloProgramatico;
use Illuminate\Support\Facades\Storage;

class ModuloDataTable extends DataTable
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
              ->addColumn('action', function($modelo){
                return view('modulos.acciones',['modulo'=>$modelo])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\Models\Modulo\Modulo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModeloProgramatico $model)
    {
        $idModeloProgramatico=$this->idModeloProgramatico;
        return $model->find($idModeloProgramatico)->modulos()->select($this->getColumns());
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
            'codigo',
            'nombre',
            'modeloProgramatico_id'            
        ];
    }
    protected function getColumnsTable()
    {
        return [
            
            'codigo'=>['title'=>'Código','data'=>'codigo'],
            'nombre',


            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Modulo_' . date('YmdHis');
    }
}
