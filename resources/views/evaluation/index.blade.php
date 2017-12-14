@extends( 'layouts.app' , [ 'menu'  =>  $menu ])

@section ( 'content' )
<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">event_note</i> Avaliações </a></li>
        <li class="active"><i class="material-icons">list</i> Avaliações</li>
    </ol>

    <div class="container-fluid">
    
        <div class="block-header">
            <h2>
                Lista de Avaliações
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
                <a href=' {{ route( 'add-evaluation' ) }} ' class="btn btn-lg btn-primary waves-effect">Adicionar</a>   
            </div> 
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                        
            
                <div class="card">
                    <div class="header">
                        <h2>
                            Avaliações
                        </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Aluno(a)</th>
                                    <th>Data de criação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Aluno(a)</th>
                                    <th>Data de criação</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ($evaluations->count() < 1 )
                                    <tr>
                                        <td colspan='5'>
                                            <center>
                                                NENHUMA AVALIAÇÃO ADICIONADA
                                            </center>
                                        </td>
                                    </tr>
                                @endif

                                @foreach($evaluations->get() as $key => $evaluation)
                                    <tr>
                                        <td>
                                            {{ $evaluation->students[0]->name }} {{ $evaluation->students[0]->middlename }} {{ $evaluation->students[0]->lastname }}
                                        </td>
                                        <td>
                                            {{ date('d/m/Y H:m:s', strtotime( $evaluation->created_at ) ) }}
                                        </td>
                                        
                                        <td class='align-center'>
                                            
                                            <div class='col-md-4 col-lg-4'>
                                                <a
                                                    href=' {{ url( 'show-evaluation/'. $evaluation->id ) }} '
                                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float pull-right"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Ver notas de  
                                                    {{ $evaluation->students[0]->name }} 
                                                    {{ $evaluation->students[0]->middlename }} 
                                                    {{ $evaluation->students[0]->lastname }}"
                                                >
                                                    <i class="material-icons">search</i>
                                                </a>
                                            </div>
                                            <div class='col-md-4 col-lg-4'>
                                                <a
                                                    href=' {{ url( 'edit-evaluation/'. $evaluation->id) }} '
                                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float pull-right"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Editar notas de 
                                                    {{ $evaluation->students[0]->name }} 
                                                    {{ $evaluation->students[0]->middlename }} 
                                                    {{ $evaluation->students[0]->lastname }}"
                                                >
                                                    <i class="material-icons">edit</i>
                                                </a>
                                            </div>
                                            
                                            <div class='col-md-4 col-lg-4'>
                                                {{
                                                    Form::open(
                                                        [
                                                            'method'    =>  'DELETE',
                                                            'route'     =>  [ 'delete-evaluation', $evaluation->id ]
                                                        ]
                                                    )
                                                }}
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float pull-right"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title=""
                                                        data-original-title="Deletar {{ $evaluation->name }}"
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