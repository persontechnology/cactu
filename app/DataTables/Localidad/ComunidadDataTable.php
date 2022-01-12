<?php

namespace cactu\DataTables\Localidad;

use cactu\Models\Localidad\Comunidad;
use Yajra\DataTables\Services\DataTable;

class ComunidadDataTable extends DataTable
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
        ->editColumn('user_id',function($comu){
            return view('localidad.comunidades.gestor',['usuario'=>$comu->usuario])->render();
        })

        ->filterColumn('user_id', function($query, $keyword) {
            $query->whereHas('usuario', function($query) use ($keyword) {
                $query->whereRaw("concat(nombre,' ',email) like ?", ["%{$keyword}%"]);
            });
        })
         
        ->addColumn('action', function($com){
            return view('localidad.comunidades.acciones',['comunidad'=>$com])->render();
        })->rawColumns(['user_id','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comunidad $model)
    {
        return $model->newQuery()->select($this->getColumns())->orderBy('nombre','asc');
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
            'user_id'
        ];
    }

    protected function getColumnsTable()
    {
        return [
            'nombre'=>['title'=>'Nombre'],
            'codigo'=>['title'=>'Código'],
            'user_id'=>['title'=>'Gestor']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Localidad_Comunidad_' . date('YmdHis');
    }
}
