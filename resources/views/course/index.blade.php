@extends( 'layouts.app' , [ 'menu'  =>  $menu ])

@section ( 'content' )
<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li>
        <li class="active"><i class="material-icons">view_list</i> Listagem de cursos</li>
    </ol>

    <div class="container-fluid">
    
        <div class="block-header">
            <h2>
                Lista de cursos
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
                <a href=' {{ route( 'add-course' ) }} ' class="btn btn-lg btn-primary waves-effect">Adicionar</a>   
            </div> 
        </div>
        
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                        
            
                <div class="card">
                    <div class="header">
                        <h2>
                            Cursos
                        </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Escola</th>
                                    <th>Data de criação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Escola</th>
                                    <th>Data de criação</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ($courses->count() < 1 )
                                    <tr>
                                        <td colspan='4'>
                                            <center>
                                                NENHUM CURSO CADASTRADO
                                            </center>
                                        </td>
                                    </tr>
                                @endif

                                @foreach($courses->get() as $key => $course)
                                    <tr>
                                        <td>
                                            {{ $course->course_name }}
                                        </td>
                                        <td>
                                            {{ $course->school_name }}
                                        </td>
                                        <td>
                                            {{ $course->create_date }}
                                        </td>
                                        <td class='align-center'>
                                            <div class='col-md-6 col-lg-6'>
                                                <a
                                                    href=' {{ url( 'edit-course/'. $course->course_id) }} '
                                                    class="btn btn-info btn-circle waves-effect waves-circle waves-float pull-right"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Editar {{ $course->course_name }}"
                                                >
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                            </div>
                                            <div class='col-md-6 col-lg-6'>
                                                {{
                                                    Form::open(
                                                        [
                                                            'method'    =>  'DELETE',
                                                            'route'     =>  [ 'delete-course/', $course->course_id,$course->school_id ]
                                                        ]
                                                    )
                                                }}
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float pull-right"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title=""
                                                        data-original-title="Deletar {{ $course->course_name }}"
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