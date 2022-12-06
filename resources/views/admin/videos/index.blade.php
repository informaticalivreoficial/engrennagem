@extends('adminlte::page')

@section('title', "Gerenciar Videos")

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><i class="fas fa-search mr-2"></i> Videos</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">                    
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item active">Videos</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<section class="content">
    <!-- Default box -->
      <div class="card card-solid">
        <div class="card-header text-right">
            <a href="{{route('videos.create')}}" class="btn btn-default"><i class="fas fa-plus mr-2"></i> Cadastrar Novo</a>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-12">                
                    @if(session()->exists('message'))
                        @message(['color' => session()->get('color')])
                            {{ session()->get('message') }}
                        @endmessage
                    @endif
                </div>            
            </div>
            @if(!empty($videos) && $videos->count() > 0)
                <div class="row d-flex align-items-stretch">
                    @foreach($videos as $video)  
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                            <div class="card bg-light" style="{{ ($video->status == '1' ? '' : 'background: #fffed8 !important;')  }}">
                                <div class="card-body pt-0">
                                    <div class="row pt-3">  
                                        <a class="j_modal_video" data-id="{{$video->id}}" data-toggle="modal" data-target="#modal-video"><div class="col-12 youtube" data-embed="{{\App\Helpers\Renato::getYoutubeHash($video->url)}}"></div></a>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right"> 
                                        <input type="checkbox" data-onstyle="success" data-offstyle="warning" data-size="mini" class="toggle-class" data-id="{{ $video->id }}" data-toggle="toggle" data-style="slow" data-on="<i class='fas fa-check'></i>" data-off="<i style='color:#fff !important;' class='fas fa-exclamation-triangle'></i>" {{ $video->status == true ? 'checked' : ''}}>
                                        @if(\Illuminate\Support\Facades\Auth::user()->admin == true || \Illuminate\Support\Facades\Auth::user()->superadmin == true)
                                            <a href="{{route('videos.edit',['id' => $video->id])}}" class="btn btn-xs btn-default"><i class="fas fa-pen"></i></a>
                                        @endif                                        
                                        <button type="button" class="btn btn-xs btn-danger text-white j_modal_btn" data-campo="{{$video->titulo}}" data-id="{{$video->id}}" data-toggle="modal" data-target="#modal-default">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach            
              </div>
            @else
                <div class="row mb-4">
                    <div class="col-12">                                                        
                        <div class="alert alert-info p-3">
                            Não foram encontrados registros!
                        </div>                                                        
                    </div>
                </div>
            @endif          
        </div>
        <!-- /.card-body -->
        <div class="card-footer paginacao">  
            {{ $videos->onEachSide(2)->links() }}
        </div>
          
      </div>
      <!-- /.card -->
</section>


<div class="modal fade" id="modal-video">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="youtube-video-container">
                    <iframe class="j_param" width="420" height="315" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('css')
<style>
    .pagination-custom{
            margin: 0;
            display: -ms-flexbox;
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }
        .pagination-custom li a {
            border-radius: 30px;
            margin-right: 8px;
            color:#7c7c7c;
            border: 1px solid #ddd;
            position: relative;
            float: left;
            padding: 6px 12px;
            width: 50px;
            height: 40px;
            text-align: center;
            line-height: 25px;
            font-weight: 600;
        }
        .pagination-custom>.active>a, .pagination-custom>.active>a:hover, .pagination-custom>li>a:hover {
            color: #fff;
            background: #007bff;
            border: 1px solid transparent;
        }
        .youtube-video-container {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .youtube-video-container::after {
            display: block;
            content: "";
            padding-top: 56.25%;
        }

        .youtube-video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
</style>
<link href="{{url(asset('backend/plugins/bootstrap-toggle/bootstrap-toggle.min.css'))}}" rel="stylesheet">
@stop

@section('js')

<script src="{{url(asset('backend/plugins/bootstrap-toggle/bootstrap-toggle.min.js'))}}"></script>
    <script>
       $(function () {

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('.j_modal_video').click(function() {
                var video_id = $(this).data('id');
                
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ route('videos.video') }}",
                    data: {
                       'id': video_id
                    },
                    success:function(data) {
                        if(data.embed){
                            $('.j_param').prop('src',data.embed);                                                        
                        }
                    }
                });
            });

            //FUNÇÃO PARA EXCLUIR
            $('.j_modal_btn').click(function() {
                var galeria_id = $(this).data('id');
                
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: "{{ route('galerias.delete') }}",
                    data: {
                       'id': galeria_id
                    },
                    success:function(data) {
                        if(data.error){
                            $('.j_param_data').html(data.error);
                            $('#id_galeria').val(data.id);
                            $('#frm').prop('action','{{ route('galerias.deleteon') }}');
                        }else{
                            $('#frm').prop('action','{{ route('galerias.deleteon') }}');
                        }
                    }
                });
            });
           
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
              event.preventDefault();
              $(this).ekkoLightbox({
                alwaysShowClose: true
              });
            }); 
            
            $('#toggle-two').bootstrapToggle({
                on: 'Enabled',
                off: 'Disabled'
            });
            
            $('.toggle-class').on('change', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var galeria_id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: '{{ route('galerias.galeriaSetStatus') }}',
                    data: {
                        'status': status,
                        'id': galeria_id
                    },
                    success:function(data) {
                        
                    }
                });
            });
            
        });
    </script>

    <script>
        function redimensiona(i) {
            window.setTimeout(function () {
                var larguraMaxima = 200; // Largura máxima permitida
                var alturaMaxima = 152;    // Altura máxima permitida
                var proporcaoMaxima = alturaMaxima / larguraMaxima;
    
                var larguraImagem = imagens[i].width;    // Largura da imagem
                var alturaImagem = imagens[i].height;  // Altura da imagem
                var proporcaoImagem = alturaImagem / larguraImagem;
    
                if (proporcaoImagem > proporcaoMaxima) {
                    proporcao = larguraMaxima / larguraImagem;   // Proporção para dimensionar a imagem
                    imagens[i].width = larguraMaxima; // Definindo nova largura
                    imagens[i].height = (alturaImagem * proporcao); // Definindo a altura com base na proporção
                }
                else {
                    proporcao = alturaMaxima / alturaImagem; // Proporção para dimensionar a imagem
                    imagens[i].height = alturaMaxima;   // Definindo nova altura
                    imagens[i].width = (larguraImagem * proporcao);  // Definindo a largura com base na proporção
                }
                youtube[i].appendChild(imagens[i]);
            }, 200);
        }
    
        // nodelist
        var youtube = document.querySelectorAll(".youtube");
        // array
        var imagens = [];
        // loop
        for (var j = 0; j < youtube.length; j++) {
            // miniatura do vídeo youtube
            var imagemYoutube = "https://img.youtube.com/vi/" + youtube[j].dataset.embed + "/sddefault.jpg";
            //
            imagens[j] = new Image();
            imagens[j].src = imagemYoutube;
            //
            imagens[j].addEventListener("load", redimensiona(j));
        }
    </script>
@endsection