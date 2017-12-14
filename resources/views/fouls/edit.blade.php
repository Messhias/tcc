@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href=' {{ route( 'evaluation' ) }} '><i class="material-icons">check_box</i> faltas</li></a>
        <li class="active"><i class="material-icons"> edit</i> Editar falta</li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Editar faltas de 
                {{ $fouls->get()[0]->students[0]->name }}
                {{ $fouls->get()[0]->students[0]->middlename }}
                {{ $fouls->get()[0]->students[0]->lastname }}
            </h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Editar faltas de 
                                {{ $fouls->get()[0]->students[0]->name }}
                                {{ $fouls->get()[0]->students[0]->middlename }}
                                {{ $fouls->get()[0]->students[0]->lastname }}
                        </h2>
                    </div>
                    <div class="body">
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        {{
                            Form::open([
                                'method'    =>  'PUT',
                                'id'        =>  'EditEvaluationStudent',
                            ])
                        }}
                            
                            <label for="student">Aluno(a)</label>
                            <div class="form-group{{ $errors->has( 'student' ) ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::hidden( 'student' ,$fouls->get()[ 0 ]->students[ 0 ]->id,['id'=>'student'] )
                                    }}
                                    {{
                                        Form::hidden('id',$fouls->get()[ 0 ]->id,['id'=>'id'])
                                    }}
                                    {{ $fouls->get()[ 0 ]->students[ 0 ]->name }}
                                    {{ $fouls->get()[ 0 ]->students[ 0 ]->middlename }}
                                    {{ $fouls->get()[ 0 ]->students[ 0 ]->lastname }}
                                </div>
                                @if ( $errors->has( 'student' ) )
                                    <span class="help-block">
                                        <strong>{{ $errors->first( 'student' ) }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <h2 class="card-inside-title">Curso</h2>
                            <div class="demo-checkbox" id='tabList'>
                                @foreach ($courses as $courses)
                                    <input name="discipline" type="checkbox" value="{{ $courses['id'] }}" id="{{ $courses['id'] }}" class="filled-in chk-col-brown courses-check-box" checked disabled=''/>
                                    <label for="{{ $courses['id'] }}">{{ $courses['name'] }}</label>
                                @endforeach
                            </div>

                            <div class='disciplines '>
                                <h2 class="card-inside-title">Selecione a disciplina</h2>
                                <div class="demo-checkbox disciplinesContainer " >
                                    @foreach($fouls->get() as $eval)
                                        
                                        <input name="discipline" type="radio" value="{{ $eval->id }}" id="{{ $eval->coursesClass->discipline->id }}" class="filled-in chk-col-brown discipline-checkbox"/>
                                        <label for="{{ $eval->coursesClass->discipline->id }}">{{ $eval->coursesClass->discipline->name }}</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class='evaluations-container hide'>
                                <h2 class="card-inside-title">Faltas</h2>
                                <div class='evaltions-inner-container'>
                                </div>
                                <div class='others-evaluations'>
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect submit">Editar!</button>
                            <a href=' {{ route( 'foul' ) }} ' class="btn btn-danger m-t-15 waves-effect">Cancelar</a>
                        {{
                            Form::close()
                        }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->
    </div>
    {{--  end container fluid  --}}
</section>
@endsection