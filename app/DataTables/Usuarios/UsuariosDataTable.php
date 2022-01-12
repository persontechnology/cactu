<?php

namespace cactu\DataTables\Usuarios;

use cactu\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class UsuariosDataTable extends DataTable
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
            ->addColumn('roles',function($user){
                return view('usuario.usuarios.roles',['user'=>$user])->render();
            })
            ->addColumn('estado', function($planificacion){
                if($planificacion->estado==1){
                    return '<span class="badge badge-info">Activo</span>';                    
                }else{
                    return '<span class="badge badge-warning">Inactivo</span>';
                }
            })
            ->addColumn('action', function($user){
                return view('usuario.usuarios.acciones',['user'=>$user])->render();
            })->rawColumns(['estado','action']);;
    }
    /**
     * Get query source of dataTable.
     *
     * @param \cactu\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->select($this->getColumns());
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
            'name',
            'email',
            'estado'
        ];
    }


    protected function getColumnsTable()
    {
        return [
            'name'=>['title'=>'Usuario'],
            'email',
            'roles',
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
        return 'Usuario_Usuarios_' . date('YmdHis');
    }
}
