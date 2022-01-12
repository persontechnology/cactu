<?php

namespace cactu\DataTables;

use cactu\Models\Mes;
use cactu\Models\Planificacion;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class PlanificacionDataTable extends DataTable
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
            ->editColumn('desde',function(Planificacion $planificacion){   
                $meses = Mes::get()->pluck('mes');
                $fecha =Carbon::parse($planificacion->desde);
                $mes = $meses[($fecha->format('n')) - 1];
                return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y');
            })
            ->editColumn('hasta',function(Planificacion $planificacion){   
                $meses = Mes::get()->pluck('mes');
                $fecha =Carbon::parse($planificacion->hasta);
                $mes = $meses[($fecha->format('n')) - 1];
                return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y');
            })
           ->addColumn('estado', function($planificacion){
                if($planificacion->estado=="proceso"){
                    return '<span class="badge badge-info">'.$planificacion->estado.'</span>';                    
                }else{
                    return '<span class="badge badge-success">'.$planificacion->estado.'</span>';
                }
            })
            ->addColumn('action', function($planificacion){
                return view('planificaciones.acciones',['planificacion'=>$planificacion])->render();
            })
            ->rawColumns(['estado','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Planificacion $model)
    {
        return $model->newQuery()->select($this->getColumns())->latest();
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
            'desde',
            'hasta',
            'estado'
        ];
    }

    protected function getColumnsTable()
    {
        return [
            'nombre',
            'desde',
            'hasta',
            'estado'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Planificacion_' . date('YmdHis');
    }
}
