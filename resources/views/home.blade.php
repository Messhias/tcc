@extends( 'layouts.app' , [ 'menu'  => $menu ] )

@section( 'content' )
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Painel</h2>
        </div>

        @include( 'layouts.dashboard.widgets' )
        
        {{--  sales graph section  --}}
            {{--  @include( "layouts.dashboard.sales-graph" )
            @include( 'layouts.dashboard.sales-graph2' )  --}}
        {{--  end sales graph section  --}}

        <!-- Task Info -->
        {{--  <div class="row clearfix">
            <!-- #END# Task Info -->
            <!-- Browser Usage -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body">
                        <div id="donut_chart" class="dashboard-donut-chart"></div>
                    </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
        </div>  --}}
    </div>
</section>
@endsection
