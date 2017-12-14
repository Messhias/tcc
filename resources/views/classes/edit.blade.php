@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li>
        <li><a href=' {{ route( 'class' ) }} '><i class="material-icons">school</i> Salas</li></a>
        <li class="active"><i class="material-icons"> playlist_edit</i> Editar {{ $class->name }}</li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Editar {{ $class->name }}</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Editar {{ $class->name }}
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

                            {{--  name  --}}
                            <label for="name">Nome</label>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="form-line">
                                    {{
                                        Form::text('name',
                                        $class->name,
                                        [
                                            'class'         =>  'form-control',
                                            'id'            =>  'name',
                                            'placeholder'   =>  'Digite o primeiro nome',
                                            'required',
                                            'autofocus',
                                        ])
                                    }}
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Editar!</button>
                            <a href=' {{ route( 'class' ) }} ' class="btn btn-danger m-t-15 waves-effect">Cancelar</a>
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