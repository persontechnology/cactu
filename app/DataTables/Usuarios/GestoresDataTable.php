<?php

namespace cactu\DataTables\Usuarios;

use cactu\User;
use Yajra\DataTables\Services\DataTable;

class GestoresDataTable extends DataTable
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

        ->addColumn('comunidades',function($user){
            return view('usuario.gestores.comunidades',['usuario'=>$user])->render();
        })
        
        ->filterColumn('comunidades', function($query, $keyword) {
            $query->whereHas('comunidades', function($query) use ($keyword) {
                $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
            });
        })


        ->addColumn('action', function($user){
            return view('usuario.gestores.acciones',['user'=>$user]);
        })
        ->rawColumns(['comunidades','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->role('Gestor')->select($this->getColumns());
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
        ];
    }


    protected function getColumnsTable()
    {
        return [
            'name'=>['title'=>'Nombre'],
            'email',
            'comunidades'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Usuarios_Gestores_' . date('YmdHis');
    }
}
