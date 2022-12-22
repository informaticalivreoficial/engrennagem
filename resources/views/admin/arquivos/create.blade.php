@extends('adminlte::page')

@section('title', 'Cadastrar Arquivo')


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
        <h1><i class="fas fa-search mr-2"></i>Cadastrar Arquivo</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Painel de Controle</a></li>
            <li class="breadcrumb-item"><a href="{{route('arquivos.index')}}">Arquivos</a></li>
            <li class="breadcrumb-item active">Cadastrar Arquivo</li>
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
                    
            
<form action="{{ route('arquivos.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
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
                            <label class="labelforms text-muted"><b>*Título do Disco</b> </label>
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
                    <div class="col-12 col-md-6 col-lg-6"> 
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>Tipo do Arquivo</b></label>
                            <select name="tipo" class="form-control">
                                <option value="ai" {{ (old('tipo') == 'ai' ? 'selected' : '') }}>Adobe Illustrator (.ai)</option>
                                <option value="png" {{ (old('tipo') == 'png' ? 'selected' : '') }}>Adobe Fireworks (.png)</option>
                                <option value="cdr" {{ (old('tipo') == 'cdr' ? 'selected' : '') }}>Corel Draw (.cdr)</option>
                                <option value="xls" {{ (old('tipo') == 'xls' ? 'selected' : '') }}>Microsoft Excel (.xls)</option>
                                <option value="doc" {{ (old('tipo') == 'doc' ? 'selected' : '') }}>Microsoft Word (.doc)</option>
                                <option value="docx" {{ (old('tipo') == 'docx' ? 'selected' : '') }}>Microsoft Word (.docx)</option>
                                <option value="dotx" {{ (old('tipo') == 'dotx' ? 'selected' : '') }}>Modelo de documento Word (.dotx)</option>
                                <option value="pdf" {{ (old('tipo') == 'pdf' ? 'selected' : '') }}>Arquivo PDF (.pdf)</option>
                                <option value="zip" {{ (old('tipo') == 'zip' ? 'selected' : '') }}>Arquivo Compactado (.zip)</option>
                            </select>
                        </div>
                    </div>           
                    <div class="col-12 col-md-6 col-lg-6"> 
                        <div class="form-group">
                            <label class="labelforms text-muted"><b>Arquivo</b></label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="arquivo" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">
                                        {{ old('arquivo') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>           
                </div>
            </div>            
        </div>
        
        <div class="row mb-2">
            <div class="col-12">   
                <label class="labelforms text-muted"><b>Descrição</b></label>
                <textarea class="form-control" rows="5" name="content">{{ old('content') }}</textarea>                                                                                     
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
    <link rel="stylesheet" href="{{url(asset('backend/plugins/jquery-tags-input/jquery.tagsinput.css'))}}" />
    <link href="{{url(asset('backend/plugins/airdatepicker/css/datepicker.min.css'))}}" rel="stylesheet" type="text/css">
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
<script src="{{url(asset('backend/plugins/jquery-tags-input/jquery.tagsinput.js'))}}"></script>
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