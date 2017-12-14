@extends( 'layouts.app' , [ 'menu'  => $menu ] )

@section( 'content' )

    <div class="four-zero-four-container">
        <div class="error-code">404</div>
        <div class="error-message">Sinto muito! Porém, a página que você procura ou está tentando acessar 
        não existe ou não está mais disponível</div>
        <div class="button-place">
            <a href="{{ url( 'home' ) }}" class="btn btn-default btn-lg waves-effect">Volte ao seu painel</a>
        </div>
    </div>
@endsection