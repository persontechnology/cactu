<?php

namespace cactu\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use cactu\Materiale;
use cactu\Models\Material;

class MaterialesDataTable extends DataTable
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
                return view('materiales.acciones',['material'=>$modelo])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\Models/CuentaContable\CuentaContable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Material $model)
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
            'precio',
            'iva'
        ];
    }
    protected function getColumnsTable()
    {
        return [
            'nombre',
            'precio',
            'iva'           
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Materiales_' . date('YmdHis');
    }
}
