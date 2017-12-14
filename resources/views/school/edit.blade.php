@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li>
        <li><a href=' {{ route( 'schools' ) }} '><i class="material-icons">school</i> Unidades</li></a>
        <li class="active"><i class="material-icons"> playlist_add</i> Editar {{ $school->school_name }}</li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Unidade {{$school->school_name }}</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Editar unidade: {{ $school->school_name }}
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
                                'route'     =>  ['edit-school-unit',$school->id_school]
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
                                        value='{{ $school->school_name }}'
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
                            
                            {{-- CNPJ --}}
                            <div class="demo-masked-input">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <b>CNPJ</b>
                                        <div class="input-group">
                                            {{--  <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>  --}}
                                            <div class="form-line">
                                                {{
                                                    Form::text('cnpj',$school->cnpj,[
                                                        'placeholder'   =>  '99.999.999/9999-99',
                                                        'class'         =>  'form-control cnpj'
                                                    ])
                                                }}                                                
                                                @if ($errors->has('cnpj'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('cnpj') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Editar!</button>
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