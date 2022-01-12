<?php

namespace cactu\DataTables\Localidad;

use cactu\Models\Localidad\Canton;
use Yajra\DataTables\Services\DataTable;

class CantonDataTable extends DataTable
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
            ->editColumn('provincia_id',function($canton){
                return $canton->provincia->nombre;
            })
            ->filterColumn('provincia_id', function($query, $keyword) {
                $query->whereHas('provincia', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($canton){
                return view('localidad.cantones.acciones',['canton'=>$canton])->render();
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
            'provincia_id'
        ];
    }

    protected function getColumnsTable()
    {
        return [
            'nombre',
            'codigo'=>['title'=>'Código'],
            'provincia_id'=>['title'=>'Provincia']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Localidad_Canton_' . date('YmdHis');
    }
}
