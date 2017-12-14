@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li>
        <li><a href=' {{ route( 'courses' ) }} '><i class="material-icons">school</i> Cursos</li></a>
        <li class="active"><i class="material-icons"> playlist_add</i> Adicionar curso</li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Cursos</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Adicionar novo curso
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
                            
                            {{-- School --}}
                            <label for="schools">Instituição</label>
                            <div class="form-group{{ $errors->has('schools') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::select(
                                            'schools[]', $schools,
                                            '',
                                            [
                                                'class'         =>  'form-control show-tick',
                                                'placeholder'   =>  'SELECIONE UMA OU MAIS INSTITUIÇÕES',
                                                'multiple',
                                                'required'
                                            ]
                                        )
                                    }}
                                </div>
                                @if ($errors->has('schools'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('schools') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Adicionar!</button>
                            <a href=' {{ route( 'schools' ) }} ' class="btn btn-danger m-t-15 waves-effect">Cancelar</a>
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