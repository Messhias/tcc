@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li><li><a href=' {{ route( 'foul' ) }} '><i class="material-icons">event_note</i> Faltas</li></a>
        <li class="active"><i class="material-icons">search</i> Visualizar faltas - 
            {{ $foul->get()[0]->students[0]->name }}
            {{ $foul->get()[0]->students[0]->middlename }}
            {{ $foul->get()[0]->students[0]->lastname }}
        </li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Faltas</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ $foul->get()[0]->students[0]->name }}
                            {{ $foul->get()[0]->students[0]->middlename }}
                            {{ $foul->get()[0]->students[0]->lastname }}

                            <a href='{{ url( 'edit-foul/' . $foul->get()[0]->id ) }}' class='btn btn-lg btn-success pull-right'>
                                Editar faltas
                            </a>
                            
                        </h2>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                        
                
                    <div class="card">

                        <div class="header">
                            <h2>
                                Faltas
                            </h2>
                        </div>
                        
                        <div class="body">

                            @foreach ($foul->get() as $fouls)
                                
                                <div class='col-12'>
                                    <hr>
                                        <p>
                                            Curso: <b> {{$fouls->coursesClass->course->name}} </b>
                                        </p>
                                        <p>
                                            Disciplina: <b>{{$fouls->coursesClass->discipline->name}} </b>
                                        </p>
                                        <p>
                                            Instituição: <b> {{ $fouls->coursesClass->course->coursesSchool->schools->name }} </b>
                                        </p>

                                        <p>
                                            <ul>
                                                <li>
                                                    Horário: <b> {{ $fouls->coursesClass->hr_start }} </b>
                                                </li>
                                                <li>
                                                    Horário: <b>{{ $fouls->coursesClass->hr_end }} </b>
                                                </li>
                                            </ul>
                                        </p>
                                        
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <center>
                                                            Quantidade
                                                        </center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>
                                                        <center>
                                                            Quantidade
                                                        </center>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            {{ $fouls->quantity }}
                                                        </center>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    <hr>
                                </div>

                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection