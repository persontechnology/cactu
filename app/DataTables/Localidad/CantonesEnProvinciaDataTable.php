<?php

namespace cactu\DataTables\Localidad;

use cactu\Models\Localidad\Provincia;
use Yajra\DataTables\Services\DataTable;

class CantonesEnProvinciaDataTable extends DataTable
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
            ->addColumn('action', function($cant){
                return view('localidad.cantones.accionesCantonEnProvincia',['canton'=>$cant])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Provincia $model)
    {
        $model=$this->provincia;
        return $model->cantones()->select($this->getColumns())->orderBy('nombre');
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
                    ->addAction(['width' => '80px','exportable' => false,'printable' => false,'title'=>'Acciones'])
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
            'codigo',
        ];
    }
    protected function getColumnsTable()
    {
        return [
            'nombre',
            'codigo'=>['title'=>'Código'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Localidad/CantonesEnProvincia_' . date('YmdHis');
    }
}
