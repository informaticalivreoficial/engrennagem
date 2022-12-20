@extends('adminlte::page')

@section('title', 'Cadastrar Evento')


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
        <h1><i class="fas fa-search mr-2"></i>Cadastrar Evento</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('agenda.index')}}">Eventos</a></li>
            <li class="breadcrumb-item active">Cadastrar Evento</li>
        </ol>
    </div>
</div> 
@stop

@section('content')
<div class="row">
    <div class="col-12">
        @if($errors->all())
             @foreach($errors->all() as $error)
                 @message(['color' => 'danger'])
                 {{ $error }}
                 @endmessage
             @endforeach
         @endif 
     </div>            
</div>   
                    
            
<form action="{{ route('agenda.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
@csrf     
<div class="row">            
<div class="col-12">
<div class="card card-teal card-outline card-outline-tabs">                            
<div class="card-header p-0 border-bottom-0">
<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">INFORMAÇÕES</a>
    </li> 
</ul>
</div>
<div class="card-body">
<div class="tab-content" id="custom-tabs-four-tabContent">
    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
        <div class="row mb-4">
            <div class="col-12 col-md-6 col-lg-4"> 
                <div class="form-group">
                    <div class="thumb_user_admin">
                        <img id="preview" src="{{url(asset('backend/assets/images/image.jpg'))}}" alt="{{ old('titulo') }}" title="{{ old('titulo') }}"/>
                        <input id="img-input" type="file" name="thumb">
                    </div>                                                
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-8">
                <div class="row mb-2">
                    <div class="col-12 col-md-8 col-lg-8"> 
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>*Título do Evento</b> </label>
                            <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4"> 
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>Status:</b></label>
                            <select name="status" class="form-control">
                                <option value="1" {{ (old('status') == '1' ? 'selected' : '') }}>Ativo</option>
                                <option value="0" {{ (old('status') == '0' ? 'selected' : '') }}>Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12"> 
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>Link das Informações</b> </label>
                            <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                        </div>
                    </div>                    
                    <div class="col-12 col-md-12 col-lg-12"> 
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>Endereço</b> </label>
                            <input type="text" class="form-control" name="endereco" value="{{ old('endereco') }}">
                        </div>
                    </div> 
                    <div class="col-12 col-md-6 col-lg-6 mb-2"> 
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>*Data do Evento</b></label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker-here" data-language='pt-BR' name="data" value="{{ old('data') }}"/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>                                                    
                    </div>  
                    <div class="col-12 col-md-12 col-lg-6"> 
                        <label class="labelforms text-muted"><b>Hora do Evento</b></label>
                        @php
                        $configtime = [
                            'format' => 'HH:mm'
                        ];
                        @endphp
                        <x-adminlte-input-date name="time" :config="$configtime" placeholder="Selecione a Hora...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-info">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-date>
                    </div>                  
                </div>
            </div>            
        </div>
        
        <div class="row mb-2">
            <div class="col-12">   
                <label class="labelforms text-muted"><b>Descrição</b></label>
                <x-adminlte-text-editor name="content" v placeholder="Descrição..." :config="$config">{{ old('content') }}</x-adminlte-text-editor>                                                                                     
            </div>            
        </div>
                
    </div> 

</div>
<div class="row text-right">
    <div class="col-12 my-3">
        <button type="submit" class="btn btn-lg btn-success"><i class="nav-icon fas fa-check mr-2"></i> Cadastrar Agora</button>
    </div>
</div> 
                        
</form>                 
            
@stop

@section('css')
    <link href="{{url(asset('backend/plugins/airdatepicker/css/datepicker.min.css'))}}" rel="stylesheet" type="text/css">
    <style type="text/css">
        
        /* Lista de ImÃ³veis */
        img {
            max-width: 100%;
        }
        .realty_list_item  {    
            border: 1px solid #F3F3F3;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }

        .border-item-imovel{
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            border: 1px solid #F3F3F3;  
            background-color: #F3F3F3;
        }
       
        .property_image, .content_image {
            width: 100%;
            flex-basis: 100%;
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
        .property_image .property_image_item, .content_image .property_image_item {
            flex-basis: calc(25% - 20px) !important;
            margin-bottom: 20px;
            margin-right: 20px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            position: relative;
        }

        .property_image .property_image_item img, .content_image .property_image_item img {
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }
        .property_image .property_image_item .property_image_actions, .content_image .property_image_item .property_image_actions {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        
         /* Foto User Admin */
         .thumb_user_admin{
        border: 1px solid #ddd;
        border-radius: 4px; 
        text-align: center;
        }
        .thumb_user_admin input[type=file]{
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
        .thumb_user_admin img{
                        
        }
    </style>
    @stop

@section('js')
<script src="{{url(asset('backend/plugins/airdatepicker/js/datepicker.min.js'))}}"></script>
<script src="{{url(asset('backend/plugins/airdatepicker/js/i18n/datepicker.pt-BR.js'))}}"></script>

<script>
    $(function () { 
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });  

        function readImage() {
            if (this.files && this.files[0]) {
                var file = new FileReader();
                file.onload = function(e) {
                    document.getElementById("preview").src = e.target.result;
                };       
                file.readAsDataURL(this.files[0]);
            }
        }
        document.getElementById("img-input").addEventListener("change", readImage, false);
        
       
       
    });
</script>
@stop