@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li><li><a href=' {{ route( 'evaluation' ) }} '><i class="material-icons">event_note</i> Avaliações</li></a>
        <li class="active"><i class="material-icons">search</i> Visualizar avaliação - 
            {{ $evaluation->get()[0]->students[0]->name }}
            {{ $evaluation->get()[0]->students[0]->middlename }}
            {{ $evaluation->get()[0]->students[0]->lastname }}
        </li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Avaliações</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ $evaluation->get()[0]->students[0]->name }}
                            {{ $evaluation->get()[0]->students[0]->middlename }}
                            {{ $evaluation->get()[0]->students[0]->lastname }}

                            <a href='{{ url( 'edit-evaluation/' . $evaluation->get()[0]->id ) }}' class='btn btn-lg btn-success pull-right'>
                                Editar notas
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
                                Avaliações
                            </h2>
                        </div>
                        
                        <div class="body">

                            @foreach ($evaluation->get() as $evaluations)
                                
                                <div class='col-12'>
                                    <hr>
                                        <p>
                                            Curso: <b> {{$evaluations->coursesClass->course->name}} </b>
                                        </p>
                                        <p>
                                            Disciplina: <b>{{$evaluations->coursesClass->discipline->name}} </b>
                                        </p>
                                        <p>
                                            Instituição: <b> {{ $evaluations->coursesClass->course->coursesSchool->schools->name }} </b>
                                        </p>

                                        <p>
                                            <ul>
                                                <li>
                                                    Horário: <b> {{ $evaluations->coursesClass->hr_start }} </b>
                                                </li>
                                                <li>
                                                    Horário: <b>{{ $evaluations->coursesClass->hr_end }} </b>
                                                </li>
                                            </ul>
                                        </p>
                                        
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th>P1</th>
                                                    <th>P2</th>
                                                    <th>P3</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>P1</th>
                                                    <th>P2</th>
                                                    <th>P3</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        {{ $evaluations->first }}
                                                    </td>
                                                    <td>
                                                        {{ $evaluations->second }}
                                                    </td>
                                                    <td>
                                                        {{ $evaluations->third }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    <hr>
                                </div>

                            @endforeach
                            
                            <h3> Outras Avaliações </h3>
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Nota</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @foreach ($others as $other )
                                    <tr>
                                        <td>
                                            {{ $other->name }}
                                        </td>
                                        <td>
                                            {{ $other->value }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection