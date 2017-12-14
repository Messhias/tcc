@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li>
        <li><a href=' {{ route( 'classroom' ) }} '><i class="material-icons">collections_bookmark</i> Salas</li></a>
        <li class="active"><i class="material-icons"> playlist_add</i> Adicionar sala de aula</li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Salas de aula</h2>
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
                            <label for="name">Nome</label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name='name' 
                                        class="form-control" 
                                        placeholder="Digite o nome"
                                        autofocus
                                        required
                                    >
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="professor">Professor</label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select('professor',$professor,'',[
                                            'required',
                                            'class'         =>  'form-control show-tick',
                                            'placeholder'   =>  'SELECIONE O PROFESSOR',

                                        ])
                                    }}
                                </div>
                                @if ($errors->has('professor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('professor') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="school">Escola</label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select('school',$school,'',[
                                            'required',
                                            'class'         =>  'form-control show-tick',
                                            'placeholder'   =>  'SELECIONE A ESCOLA',

                                        ])
                                    }}
                                </div>
                                @if ($errors->has('school'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="class">Sala</label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select('class',$class,'',[
                                            'required',
                                            'class'         =>  'form-control show-tick',
                                            'placeholder'   =>  'SELECIONE A ESCOLA',

                                        ])
                                    }}
                                </div>
                                @if ($errors->has('class'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="discipline">Disciplina</label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select('discipline',$discipline,'',[
                                            'required',
                                            'class'         =>  'form-control show-tick',
                                            'placeholder'   =>  'SELECIONE A ESCOLA',

                                        ])
                                    }}
                                </div>
                                @if ($errors->has('discipline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('discipline') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="course">Curso</label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select('course',$course,'',[
                                            'required',
                                            'class'         =>  'form-control show-tick',
                                            'placeholder'   =>  'SELECIONE A ESCOLA',

                                        ])
                                    }}
                                </div>
                                @if ($errors->has('course'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Adicionar!</button>
                            <a href=' {{ route( 'classroom' ) }} ' class="btn btn-danger m-t-15 waves-effect">Cancelar</a>
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