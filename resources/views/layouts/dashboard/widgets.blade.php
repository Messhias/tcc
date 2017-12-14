
<!-- Widgets -->
<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
                <i class="material-icons">location_city</i>
            </div>
            <div class="content">
                <div class="text">Escolas</div>
                <div 
                    class               =   "number count-to" 
                    data-from           =   "0" 
                    data-to             =   "{{$school->count()}}" 
                    data-speed          =   "1000" 
                    data-fresh-interval =   "10"
                ></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons"> person </i>
            </div>
            <div class="content">
                <div class="text">Alunos</div>
                <div 
                    class="number count-to" 
                    data-from="0" 
                    data-to="{{ $students->count() }}" 
                    data-speed="1000" 
                    data-fresh-interval="10"
                ></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
                <i class="material-icons">format_align_justify</i>
            </div>
            <div class="content">
                <div class="text">Cursos</div>
                <div 
                    class="number count-to" 
                    data-from="0" 
                    data-to="{{ $course->count() }}" 
                    data-speed="1000" 
                    data-fresh-interval="10"
                ></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">account_circle</i>
            </div>
            <div class="content">
                <div class="text">Professores</div>
                <div 
                    class="number count-to" 
                    data-from="0" 
                    data-to="{{ $professor->count() }}" 
                    data-speed="1000" 
                    data-fresh-interval="10"
                ></div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Widgets -->