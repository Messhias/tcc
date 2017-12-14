@extends( 'layouts.app' , [ 'menu'  =>  $menu ])

@section ( 'content' )
<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">check_box</i> Faltas </a></li>
        <li class="active"><i class="material-icons">list</i> faltas</li>
    </ol>

    <div class="container-fluid">
    
        <div class="block-header">
            <h2>
                Lista de faltas
            </h2>

            @if( Session::has( 'AddMessage' ) )
                <div class="alert bg-green alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ Session::get('AddMessage') }}
                </div>
            @endif

            @if( Session::has( 'ErrorMessage' ) )
                <div class="alert bg-pink alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ Session::get('ErrorMessage') }}
                </div>
            @endif
            
        </div>
        <div class='card'>
            
            <div class="header">
                <a href=' {{ route( 'add-foul' ) }} ' class="btn btn-lg btn-primary waves-effect">Adicionar</a>   
            </div> 
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                        
            
                <div class="card">
                    <div class="header">
                        <h2>
                            faltas
                        </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Aluno(a)</th>
                                    <th>Data de atualização</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Aluno(a)</th>
                                    <th>Data de atualização</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ($fouls->count() < 1 )
                                    <tr>
                                        <td colspan='5'>
                                            <center>
                                                NENHUMA FALTA LANÇADA
                                            </center>
                                        </td>
                                    </tr>
                                @endif

                                @foreach($fouls->get() as $key => $foul)
                                    <tr>
                                        <td>
                                            {{ $foul->students[0]->name }} {{ $foul->students[0]->middlename }} {{ $foul->students[0]->lastname }}
                                        </td>
                                        <td>
                                            {{ date('d/m/Y H:m:s', strtotime( $foul->created_at ) ) }}
                                        </td>
                                        
                                        <td class='align-center'>
                                            <div class='col-md-4 col-lg-4'>
                                                <a
                                                    href=' {{ url( 'show-foul/'. $foul->id ) }} '
                                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float pull-right"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Ver faltas de  
                                                    {{ $foul->students[0]->name }} 
                                                    {{ $foul->students[0]->middlename }} 
                                                    {{ $foul->students[0]->lastname }}"
                                                >
                                                    <i class="material-icons">search</i>
                                                </a>
                                            </div>
                                            <div class='col-md-4 col-lg-4'>
                                                <a
                                                    href=' {{ url( 'edit-foul/'. $foul->id) }} '
                                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float pull-right"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Editar faltas de 
                                                    {{ $foul->students[0]->name }} 
                                                    {{ $foul->students[0]->middlename }} 
                                                    {{ $foul->students[0]->lastname }}"
                                                >
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </div>
                                            
                                            <div class='col-md-4 col-lg-4'>
                                                {{
                                                    Form::open(
                                                        [
                                                            'method'    =>  'DELETE',
                                                            'route'     =>  [ 'delete-foul', $foul->id ]
                                                        ]
                                                    )
                                                }}
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float pull-right"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title=""
                                                        data-original-title="Deletar {{ $foul->name }}"
                                                    >
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                {{
                                                    Form::close()
                                                }}
                                            </div>
                                        <td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
@endsection