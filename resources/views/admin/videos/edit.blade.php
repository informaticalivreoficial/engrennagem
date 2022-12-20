@extends('adminlte::page')

@section('title', 'Editar Vídeo')

@php
$config = [
    "height" => "300",
    "fontSizes" => ['8', '9', '10', '11', '12', '14', '18'],
    "lang" => 'pt-BR',
    "toolbar" => [
        // [groupName, [list of button]]
        ['style', ['style']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['style', ['bold', 'italic', 'underline', 'clear']],
        //['font', ['strikethrough', 'superscript', 'subscript']],        
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video','hr']],
        ['view', ['fullscreen', 'codeview']],
    ],
]
@endphp



@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Editar Vídeo</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('videos.index')}}">Vídeos</a></li>
            <li class="breadcrumb-item active">Editar Vídeo</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<section class="content text-muted">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if($errors->all())
                @foreach($errors->all() as $error)
                    @message(['color' => 'danger'])
                    {{ $error }}
                    @endmessage
                @endforeach
            @endif   
            
            @if(session()->exists('message'))
                @message(['color' => session()->get('color')])
                    {{ session()->get('message') }}
                @endmessage
            @endif 
            </div>            
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-teal card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-conteudo" role="tab" aria-controls="custom-tabs-conteudo" aria-selected="true">Conteúdo</a>
                            </li>                            
                        </ul>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('videos.update',['id' => $video->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')    
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-conteudo" role="tabpanel" aria-labelledby="custom-tabs-conteudo-tab">
                                                       
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label class="labelforms"><b>*Título:</b></label>
                                            <input class="form-control" name="titulo" placeholder="Título" value="{{old('titulo') ?? $video->titulo}}">
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-5">
                                        <div class="form-group">
                                            <label class="labelforms text-muted"><b>Url</b> <small class="text-info">(Ex: https://www.youtube.com/watch?v=Vtv5aGwjHlY)</small></label>
                                            <input class="form-control" name="url" placeholder="Url" value="{{old('url') ?? $video->url}}">
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label class="labelforms text-muted"><b>Status:</b></label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ (old('status') == '1' ? 'selected' : ($video->status == '1' ? 'selected' : '')) }}>Ativo</option>
                                                <option value="0" {{ (old('status') == '0' ? 'selected' : ($video->status == '0' ? 'selected' : '')) }}>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="row">
                                    <div class="col-12 mb-1"> 
                                        <div class="form-group">
                                            <label class="labelforms"><b>Embed</b></label>
                                            <textarea class="form-control" rows="5" name="embed">{{ old('embed') ?? $video->embed }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">   
                                        <label class="labelforms"><b>Conteúdo:</b></label>
                                        <x-adminlte-text-editor name="content" v placeholder="Conteúdo da galeria..." :config="$config">{{ old('content') ?? $video->content }}</x-adminlte-text-editor>                                                      
                                    </div>
                                </div> 

                            </div> 
                        </div> 
                        <div class="row text-right">
                            <div class="col-12 mb-4">
                                <button type="submit" class="btn btn-success btn-lg"><i class="nav-icon fas fa-check mr-2"></i> Atualizar Agora</button>
                            </div>
                        </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
    <link rel="stylesheet" href="{{url('backend/plugins/jquery-tags-input/jquery.tagsinput.css')}}" />
    <style type="text/css">
        div.tagsinput span.tag {
            background: #65CEA7 !important;
            border-color: #65CEA7;
            color: #fff;
            border-radius: 15px;
            -webkit-border-radius: 15px;
            padding: 3px 10px;
        }
        div.tagsinput span.tag a {
            color: #43886e;    
        }
       
        .embed {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
        }
    </style>
@stop

@section('js')
<!--tags input-->
<script src="{{url('backend/plugins/jquery-tags-input/jquery.tagsinput.js')}}"></script>
    <script>
        $(function () {            
            //tag input
            function onAddTag(tag) {
                alert("Adicionar uma Tag: " + tag);
            }
            function onRemoveTag(tag) {
                alert("Remover Tag: " + tag);
            }
            function onChangeTag(input,tag) {
                alert("Changed a tag: " + tag);
            }
            $(function() {
                $('#tags_1').tagsInput({
                    width:'auto',
                    height:200
                });
            });
        });
    </script>
@stop