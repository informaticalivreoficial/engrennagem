@extends('adminlte::page')

@section('title', 'Painel de Controle')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Painel de Controle</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
            <li class="breadcrumb-item active">Painel de Controle</li>
        </ol>
    </div><!-- /.col -->
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-success"><a href="{{route('galerias.index')}}" title="Galerias"><i class="fa far fa-images"></i></a></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>Galerias</b></span>
                    <span class="info-box-text">Ativas: {{ $galeriasAvailable }}</span>
                    <span class="info-box-text">Inativas: {{ $galeriasUnavailable }}</span>
                    <span class="info-box-text">Fotos: {{ $galeriasImages }}</span>
                </div>            
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-info"><a href="{{route('videos.index')}}" title="Vídeos"><i class="fa far fa-video"></i></a></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>Vídeos</b></span>
                    <span class="info-box-text">Publicado: {{ $videosAvailable }}</span>
                    <span class="info-box-text">Rascunho: {{ $videosUnavailable }}</span>
                    <span class="info-box-text">Total: {{ $videosAvailable + $videosUnavailable }}</span>
                </div>            
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-teal"><a href="{{route('agenda.index')}}" title="Eventos"><i class="fa far fa-newspaper"></i></a></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>Eventos</b></span>
                    <span class="info-box-text">Publicado: {{ $eventoAvailable }}</span>
                    <span class="info-box-text">Rascunho: {{ $eventoUnavailable }}</span>
                    <span class="info-box-text">Total: {{ $eventoAvailable + $eventoUnavailable }}</span>
                </div>
            </div>
        </div> 
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-teal"><a href="{{route('listas')}}" title="Newsletter"><i class="fa far fa-envelope"></i></a></span>

                <div class="info-box-content">
                    <span class="info-box-text"><b>Newsletter</b></span>
                    <span class="info-box-text">Listas: {{ $listas }}</span>
                    <span class="info-box-text">Emails: {{ $emails }}</span>
                    <span class="info-box-text">Envios: {{ $emailsCount }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>       
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            
        </div>
    </div>

    <div class="row">
        <section class="col-lg-6 connectedSortable">
            <div class="card card-teal">
                <div class="card-header">
                    <h3 class="card-title">Visitas/Últimos 6 meses</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </section>
        <section class="col-lg-6 connectedSortable">
            <!-- DONUT CHART -->
            <div class="card card-teal">
                <div class="card-header">
                    <h3 class="card-title">Dispositivos/Últimos 6 meses</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </section>
    </div>
@stop

@section('footer')
    <div class="pull-right hidden-xs">
        <b>Versão</b> {{env('VERSAO_SISTEMA')}}
    </div>
    <strong>Copyright © 2005 - {{date('Y')}} <a href="https://informaticalivre.com.br">Informática Livre</a>.</strong>
@endsection

@section('css')
<link rel="stylesheet" href="{{url(asset('backend/plugins/ekko-lightbox/ekko-lightbox.css'))}}">
<style>
    .info-box .info-box-content {   
        line-height: 120%;
    }
</style>
@endsection

@section('js')
<script src="{{url(asset('backend/plugins/ekko-lightbox/ekko-lightbox.min.js'))}}"></script>

<script>  
    $(function (){

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
            alwaysShowClose: true
            });
        }); 
        
    }); 
</script>
@stop
