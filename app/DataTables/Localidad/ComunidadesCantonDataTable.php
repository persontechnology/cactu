<?php

namespace cactu\DataTables\Localidad;

use cactu\Models\Localidad\Canton;
use Yajra\DataTables\Services\DataTable;

class ComunidadesCantonDataTable extends DataTable
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
            ->addColumn('action', function($com){
                return view('localidad.comunidades.accionesCantonSolo',['comunidad'=>$com])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Canton $model)
    {
        $model=$this->canton;
        return $model->comunidades()->select($this->getColumns());
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
        return 'Localidad_ComunidadesCanton_' . date('YmdHis');
    }
}
