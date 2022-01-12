<?php

namespace cactu\DataTables;

use cactu\Models\Actividad;
use cactu\Models\ModeloProgramatico;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Storage;
class ActividadDataTable extends DataTable
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
            ->editColumn('modeloProgramatico_id',function( $actividad){
                $codigoCa=$actividad->modeloProgramatico->codigo.''.$actividad->codigo;
                return $codigoCa;
            })
            ->filterColumn('modeloProgramatico_id',function($query, $keyword){
                $query->whereHas('modeloProgramatico', function($query) use ($keyword) {
                    $query->whereRaw("concat(codigo,'',actividad.codigo) like ?", ["%{$keyword}%"]);
                });            
            })
            ->addColumn('action', function($modelo){
                return view('actividades.acciones',['actividad'=>$modelo])->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\Models\Actividad\Actividad $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModeloProgramatico $model)
    {
        $idModeloProgramatico=$this->idModeloProgramatico;
        return $model->find($idModeloProgramatico)->actividades()->select($this->getColumns());
    }
    /*NA  221-01*/
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
            'codigo',
            'modeloProgramatico_id'            
        ];
    }
    protected function getColumnsTable()
    {
        return [
            
            'nombre',
            'modeloProgramatico_id'=>['title'=>'Código','data'=>'modeloProgramatico_id'],


            
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Actividad_' . date('YmdHis');
    }
}
