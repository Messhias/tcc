@extends( 'layouts.app', [ 'menu' => $menu ] )

@section( 'content' )

<section class="content">

    <ol class="breadcrumb breadcrumb-col-pink">
        <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
        <li><a href="javascript:void(0);"><i class="material-icons">domain</i> Instituições </a></li>
        <li><a href=' {{ route( 'students' ) }} '><i class="material-icons">school</i> Aluno</li></a>
        <li class="active"><i class="material-icons"> playlist_add</i> Editar {{ $student->name }}</li>
    </ol>


    <div class="container-fluid">
        <div class="block-header">
            <h2>Editar {{ $student->name }}</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Editar {{ $student->name }}
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
                            <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'>
                                <label for="name">Nome</label>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="form-line">
                                        {{
                                            Form::text('name',
                                            $student->name,
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
                            </div>
                            
                            
                            {{--  middlename  --}}
                            <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'>
                                <label for="middlename">Nome do meio</label>
                                <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                                    <div class="form-line">
                                        {{
                                            Form::text('middlename',
                                            $student->middlename,
                                            [
                                                'class'         =>  'form-control',
                                                'id'            =>  'middlename',
                                                'placeholder'   =>  'Digite o primeiro nome do meio',
                                                'required',
                                                'autofocus',
                                            ])
                                        }}
                                    </div>
                                    @if ($errors->has('middlename'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('middlename') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {{--  lastname  --}}
                            <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4'>
                                <label for="lastname">Ultimo nome</label>
                                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                    <div class="form-line">
                                        {{
                                            Form::text('lastname',
                                            $student->lastname
                                            ,
                                            [
                                                'class'         =>  'form-control',
                                                'id'            =>  'lastname',
                                                'placeholder'   =>  'Digite o ultimo nome',
                                                'required',
                                                'autofocus',
                                            ])
                                        }}
                                    </div>
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {{--  birthdate  --}}
                            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                <div class="demo-masked-input">
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <b>Data de nascimento</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">date_range</i>
                                                </span>
                                                <div class="form-line">
                                                    {{
                                                        Form::date('birthdate',
                                                        date( 'd/m/Y', strtotime( $student->birthdate ) ),
                                                        [
                                                            'placeholder'   =>  'Ex: 04/10/1990',
                                                            'class'         =>  'form-control date',
                                                            'value'         =>   date( 'd/m/Y', strtotime( $student->birthdate ) )
                                                        ])
                                                    }}                                                
                                                    @if ($errors->has('birthdate'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('birthdate') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <b>Celular</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone_iphone</i>
                                                </span>
                                                <div class="form-line">
                                                    {{
                                                        Form::text('mobile',
                                                        $student->mobile
                                                        ,
                                                        [
                                                            'class'         =>  'form-controm mobile-phone-number',
                                                            'placeholder'   =>  'Ex: +55 (13) 98100-6659'
                                                        ])
                                                    }}
                                                    @if ($errors->has('mobile'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('mobile') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <b>Telefone</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <div class="form-line">                                            
                                                    {{
                                                        Form::text('phone',
                                                        $student->phone,
                                                        [
                                                            'class'         =>  'form-controm phone-number',
                                                            'placeholder'   =>  'Ex: +55 (13) 8100-6659'
                                                        ])
                                                    }}
                                                    @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{--  gender  --}}
                            <div class='col-xs-12 col-sm-12 col-lg-4 col-md-4'>
                                <label for="gender">Sexo:</label>
                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <div class="form-line">
                                        {{
                                            Form::select('gender',
                                                [
                                                    ''  =>  'SELECIONE',
                                                    'F' =>  'Feminino',
                                                    'M' =>  'Masculino',
                                                ],
                                                [
                                                    'class'         =>  'form-control show-tick',
                                                    'placeholder'   =>  'SELECIONE UMA OU MAIS INSTITUIÇÕES',
                                                    'required',
                                                    'selected'  =>  $student->gender
                                                ]
                                            )
                                        }}
                                    </div>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {{--  zipcode  --}}
                            <div class='col-xs-12 col-sm-12 col-lg-4 col-md-4'>
                                <div class="demo-masked-input">
                                    <label for="zipcode">Código postal:</label>
                                    <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                        <div class="form-line">
                                            {{
                                                Form::text( 'zipcode',
                                                $student->zipcode,
                                                [
                                                    'class'         =>  'form-control zipcode-mask-br',
                                                    'id'            =>  'zipcode',
                                                    'placeholder'   =>  'XXXXX - XXX',
                                                    'required',
                                                ])
                                            }}
                                        </div>
                                        @if ($errors->has('zipcode'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zipcode') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{--  city  --}}
                            <div class='col-xs-12 col-sm-12 col-lg-4 col-md-4'>
                                <label for="city">Cidade:</label>
                                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                    <div class="form-line">
                                        {{
                                            Form::text( 'city',
                                            $student->city_id,
                                            [
                                                'class' =>  'form-control',
                                                'id'    =>  'city',
                                                'required',
                                            ])
                                        }}
                                    </div>
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {{--  states  --}}
                            <div class='col-xs-12 col-sm-12 col-lg-4 col-md-4'>
                                <label for="state">Estado:</label>
                                <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                    <div class="form-line">
                                        {{
                                            Form::text( 'state',
                                            $student->state,
                                            [
                                                'class'         =>  'form-control',
                                                'id'            =>  'state',
                                                'placeholder'   =>  'Digite seu estado',
                                                'required',
                                            ])
                                        }}
                                    </div>
                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {{--  Bairro  --}}
                            <div class='col-xs-12 col-sm-12 col-lg-8 col-md-8'>
                                <label for="neighborhood">Bairro:</label>
                                <div class="form-group{{ $errors->has('neighborhood') ? ' has-error' : '' }}">
                                    <div class="form-line">
                                        {{
                                            Form::text( 'neighborhood',
                                            $student->neighborhood,
                                            [
                                                'class'         =>  'form-control',
                                                'id'            =>  'neighborhood',
                                                'placeholder'   =>  'Digite seu bairro',
                                                'required',
                                            ])
                                        }}
                                    </div>
                                    @if ($errors->has('neighborhood'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('neighborhood') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{--  CPF, school and email  --}}
                            <div class='col-xs-12 col-sm-12 col-lg-12 col-md-12'>

                                <div class="demo-masked-input col-lg-4 col-md-4">
                                    <label for="cpf">CPF:</label>
                                    <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                        <div class="form-line">
                                            {{
                                                Form::text( 'cpf',
                                                $student->cpf,
                                                [
                                                    'class'         =>  'form-control cpf-mask',
                                                    'id'            =>  'cpf',
                                                    'placeholder'   =>  'XXXXX - XXX',
                                                    'required',
                                                ])
                                            }}
                                        </div>
                                        @if ($errors->has('cpf'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cpf') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class='col-xs-12 col-sm-12 col-lg-4 col-md-4'>
                                    <label for="email">E-mail:</label>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="form-line">
                                            {{
                                                Form::email(
                                                    'email',
                                                    $student->email,
                                                    [
                                                        'class'         =>  'form-control',
                                                        'id'            =>  'email',
                                                        'placeholder'   =>  'xxxxx@xxxx.xx',
                                                        'required',
                                                        'value'         =>  $student->email
                                                    ]
                                                )
                                            }}
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Editar!</button>
                            <a href=' {{ route( 'students' ) }} ' class="btn btn-danger m-t-15 waves-effect">Cancelar</a>
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