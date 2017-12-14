@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li>
        <li><a href=' {{ route( 'plates' ) }} '><i class="material-icons">assignment</i> Matrículas</li></a>
        <li class="active"><i class="material-icons"> playlist_add</i> Adicionar matrícula</li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Matrícula</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Adicionar nova sala de aula
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
                                'method'    =>  'POST',
                            ])
                        }}
                            {{
                                Form::hidden('class','')
                            }}
                            {{
                                Form::hidden('school','')
                            }}
                            {{
                                Form::hidden('discipline','')
                            }}

                            <label for="classroom">Turma</label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select('classroom',$classroom,'',[
                                            'required',
                                            'class'         =>  'form-control show-tick',
                                            'placeholder'   =>  'SELECIONE A TURMA',

                                        ])
                                    }}
                                </div>
                                @if ($errors->has('classroom'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('classroom') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <h2 class="card-inside-title">Matricular alunos na turma</h2>
                            <div class="demo-checkbox">
                                @foreach($students->get() as $k => $student)
                                    <input 
                                        type="checkbox" 
                                        id="{{ $student->aluno_name }}" 
                                        class="filled-in chk-col-deep-orange" 
                                        value="{{ $student->aluno_id }}" 
                                        name='students[]'
                                    />
                                    <label for="{{ $student->aluno_name }}">{{$student->aluno_name}}</label>
                                @endforeach
                            </div>

                        
                            <div class="body">
                                <div class="demo-masked-input">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <b>Inicio</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">access_time</i>
                                                </span>
                                                <div class="form-line">
                                                    <input 
                                                        type="text" 
                                                        class="form-control time24" 
                                                        placeholder="Ex: 23:59"
                                                        name = 'start'
                                                        id = 'start'
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <b>Fim</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">access_time</i>
                                                </span>
                                                <div class="form-line">
                                                    <input 
                                                        type="text" 
                                                        class="form-control time24" 
                                                        placeholder="Ex: 23:59"
                                                        name = 'end'
                                                        id = 'end'
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Adicionar!</button>
                            <a href=' {{ route( 'plates' ) }} ' class="btn btn-danger m-t-15 waves-effect">Cancelar</a>
                        {{
                            Form::close()
                        }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->
    </div>
    
</section>
@endsection