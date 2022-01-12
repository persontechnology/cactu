<?php

namespace cactu\DataTables\Localidad;

use cactu\Models\Localidad\Provincia;
use Yajra\DataTables\Services\DataTable;

class ProvinciaDataTable extends DataTable
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
            ->addColumn('coordinadores',function($pro){
                return view('localidad.provincias.coordinadores',['provincia'=>$pro])->render();
            })
            ->filterColumn('coordinadores', function($query, $keyword) {
                $query->whereHas('coordinadores', function($query) use ($keyword) {
                    $query->whereRaw("name like ?", ["%{$keyword}%"]);
                });
            })
            ->addColumn('action', function($pro){
                return view('localidad.provincias.acciones',['pro'=>$pro])->render();
            })
            ->rawColumns(['coordinadores','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Provincia $model)
    {
        return $model->newQuery()->select($this->getColumns())->orderBy('nombre');
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
            'nombre'=>['title'=>'Nombre'],
            'codigo'=>['title'=>'Código'],
            'coordinadores'=>['data'=>'coordinadores','name'=>'coordinadores']
        ];
    }
    

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Localidad/Provincia_' . date('YmdHis');
    }
}
