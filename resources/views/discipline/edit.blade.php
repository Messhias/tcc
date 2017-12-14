@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li>
        <li><a href=' {{ route( 'disciplines' ) }} '><i class="material-icons">collections_bookmark</i> Disciplinas</li></a>
        <li class="active"><i class="material-icons"> playlist_add</i> Editar {{ $discipline->name}}</li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>disciplinas</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Editar {{ $discipline->name }}
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
                                        value = '{{ $discipline->name }}'
                                    >
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            
                            {{-- School --}}
                            <label for="courses">Instituição</label>
                            <div class="form-group{{ $errors->has('courses') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select(
                                            'courses', $courses,
                                            $discipline->course_id,
                                            [
                                                'class'         =>  'form-control show-tick',
                                                'placeholder'   =>  'SELECIONE O CURSO',
                                                'required',
                                            ]
                                        )
                                    }}
                                </div>
                            </div>
                            
                            <h2 class="card-inside-title">Descrição</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{
                                                Form::textarea(
                                                    'description',
                                                    $discipline->description,
                                                    [
                                                        'rows'          =>  4,
                                                        'class'         =>  'form-control no-resize',
                                                        'placeholder'   =>  "Descrição da disciplina"
                                                    ]
                                                )
                                            }}
                                            {{--  <textarea rows="4" class="form-control no-resize" placeholder="Descrição da disciplina"></textarea>  --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Editar dados!</button>
                            <a href=' {{ route( 'disciplines' ) }} ' class="btn btn-danger m-t-15 waves-effect">Cancelar</a>
                        {{
                            Form::close()
                        }}
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->
    
</section>
@endsection