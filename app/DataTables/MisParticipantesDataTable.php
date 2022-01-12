<?php

namespace cactu\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use cactu\MisParticipante;
use cactu\Models\Ninio;
use Illuminate\Support\Facades\Auth;

class MisParticipantesDataTable extends DataTable
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
            ->editColumn('comunidad_id',function($ninio){                
                return $ninio->comunidad->nombre;
            })
            ->editColumn('tipoParticipante_id',function($ninio){                
                return $ninio->tipoParticipante->nombre;
            })
            ->editColumn('user_id',function($ninio){
                if(!$ninio->user_id){
                    return $ninio->nombres ;     
                }else{
                    return $ninio->usuario->name;
                }   
                
            })
            ->filterColumn('user_id', function($query, $keyword) {
                
                    $query->whereRaw("ninio.nombres like ?", ["%{$keyword}%"]);
                                    
            })  

            ->filterColumn('comunidad_id', function($query, $keyword) {
                $query->whereHas('comunidad', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });
            })
            ->filterColumn('tipoParticipante_id', function($query, $keyword) {
                $query->whereHas('tipoParticipante', function($query) use ($keyword) {
                    $query->whereRaw("nombre like ?", ["%{$keyword}%"]);
                });
            })
            ->addColumn('familia', function($modelo){
                $url=route('familiaMiParticipante', $modelo->id);
                if($modelo->familia){
                    if($modelo->familia->otro2 || $modelo->familia->otro3){
                        return '<a href="'.$url.'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Familia de '.$modelo->nombres.'"><i class="icon-collaboration"></i></a>';
                    }else{
                        return '<a href="'.$url.'" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Familia de '.$modelo->nombres.'"><i class="icon-collaboration"></i></a>';
                    }
                 }else{
                    return '<a href="'.$url.'" class="btn btn-danger" data-toggle="tooltip" data-placement="top"       title="Familia de '.$modelo->nombres.'"><i class="icon-collaboration"></i></a>';
                 }
                
            })
            ->addColumn('archivos', function($modelo){
                return view('ninios.miParticipantes.accionArchivo',['ninio'=>$modelo])->render();
            })
            ->addColumn('action', function($modelo){
                return view('ninios.miParticipantes.acciones',['ninio'=>$modelo])->render();
            })
            ->rawColumns(['familia','archivos','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\MisParticipante $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ninio $model)
    {
        $comunidades_id=Auth::user()->comunidades->pluck('id');
        return $model->whereIn('comunidad_id',$comunidades_id)->select($this->getColumns());
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
            'comunidad_id',
            'tipoParticipante_id',      
            'numeroChild',
            'nombres',
            'user_id'
            
           

        ];
    }
    protected function getColumnsTable()
    {
        return [
                     
            'comunidad_id'=>['title'=>'Comunidad'],
            'tipoParticipante_id'=>['title'=>'Tipo Participante'],    
            'numeroChild'=>['title'=>'N. Child.'],
            'user_id'=>['title'=>'Nombres','data'=>'user_id'],
            'familia'=>['printable' => false, 'exportable' => false],
            'archivos'=>['printable' => false, 'exportable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MisParticipantes_' . date('YmdHis');
    }
}
