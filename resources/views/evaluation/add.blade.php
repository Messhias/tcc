@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href=' {{ route( 'evaluation' ) }} '><i class="material-icons">event_note</i> Avaliações</li></a>
        <li class="active"><i class="material-icons"> playlist_add</i> Adicionar avaliação</li>
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
                            Adicionar nova avaliação
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
                                'id'        =>  'frmEvaluation',
                                'class'     =>  '',
                                'role'      =>  'form',
                            ])
                        }}
                            <label for="student">Aluno(a)</label>
                            <div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select(
                                            'student',
                                            $students,
                                            '',
                                            [
                                                'class'         =>  'form-control',
                                                'id'            =>  'evaluationStudent',
                                                'placeholder'   =>  'Selecione o aluno',
                                                'required'
                                            ]
                                        )
                                    }}
                                </div>
                                @if ($errors->has('student'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('student') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <h2 class="card-inside-title">Selecione o aluno para listar os cursos do mesmo</h2>
                            <div class="demo-checkbox" id='tabList'>
                            </div>

                            <div class='disciplines hide'>
                                <h2 class="card-inside-title">Selecione a disciplina</h2>
                                <div class="demo-checkbox disciplinesContainer hide" >

                                </div>
                            </div>

                            <div class='evaluations-container hide'>
                                <h2 class="card-inside-title">Lance as notas e/ou adicione mais</h2>
                                <div class='evaltions-inner-container'>
                                </div>
                                <div class='others-evaluations'>
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect submit">Adicionar!</button>
                            <a href=' {{ route( 'evaluation' ) }} ' class="btn btn-danger m-t-15 waves-effect">Cancelar</a>
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