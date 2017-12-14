@extends( 'layouts.app' , [ 'menu'  =>  $menu ])

@section ( 'content' )
<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">assignment</i> Matrículas </a></li>
        <li class="active"><i class="material-icons">list</i> Matrículas</li>
    </ol>

    <div class="container-fluid">
    
        <div class="block-header">
            <h2>
                Lista de Matrículas
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
                <a href=' {{ route( 'add-plates' ) }} ' class="btn btn-lg btn-primary waves-effect">Adicionar</a>   
            </div> 
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                        
            
                <div class="card">
                    <div class="header">
                        <h2>
                            Matrículas
                        </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Sala de aula</th>
                                    <th>Disciplina</th>
                                    <th>Data de criação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Sala de aula</th>
                                    <th>Disciplina</th>
                                    <th>Data de criação</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ($plates->count() < 1 )
                                    <tr>
                                        <td colspan='5'>
                                            <center>
                                                NENHUM(A) SALA
                                            </center>
                                        </td>
                                    </tr>
                                @endif

                                @foreach($plates->get() as $key => $plate)
                                    <tr>
                                        <td>
                                            {{ $plate->name }}
                                        </td>
                                        <td>
                                            {{ $plate->classes[0]->name}}
                                        </td>
                                        <td>
                                            {{ $plate->disciplines[0]->name }}
                                        </td>
                                        <td>
                                            {{ date('d/m/Y H:m:s', strtotime( $plate->created_at ) ) }}
                                        </td>
                                        <td class='align-center'>

                                            {{--  <div class='col-md-6 col-lg-6'>
                                                <a
                                                    href=' {{ url( 'edit-plates/'. $plate->id) }} '
                                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float pull-right"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Ver alunos {{ $plate->name }}"
                                                >
                                                    <i class="material-icons">person</i>
                                                </a>
                                            </div>  --}}
                                            
                                            <div class='col-md-6 col-lg-6'>
                                                {{
                                                    Form::open(
                                                        [
                                                            'method'    =>  'DELETE',
                                                            'route'     =>  [ 'delete-plates', $plate->id ]
                                                        ]
                                                    )
                                                }}
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float pull-right"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title=""
                                                        data-original-title="Deletar {{ $plate->name }}"
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