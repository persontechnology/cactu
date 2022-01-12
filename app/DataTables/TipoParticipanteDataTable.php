<?php

namespace cactu\DataTables;

use cactu\Models\TipoParticipante;
use Yajra\DataTables\Services\DataTable;

class TipoParticipanteDataTable extends DataTable
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
                return view('tipoParticipantes.acciones',['tipoParticipante'=>$modelo])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\Models/TipoParticipante\TipoParticipante $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TipoParticipante $model)
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
            'nombre'
        ];
    }
       protected function getColumnsTable()
    {
        return [
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
        return 'TipoParticipante_' . date('YmdHis');
    }
}
