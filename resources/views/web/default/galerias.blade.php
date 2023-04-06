@extends("web.{$configuracoes->template}.master.master")

@section('content')

    @if (!empty($galerias) && $galerias->count() > 0)
        <section id="fotos"> 
            <div class="light-wrapper">  
                <div class="divide10"></div>
                <div class="container inner scrolling-pagination">
                    
                    <div class="row">
                        @php $count = 0; @endphp
                        @foreach ($galerias as $key => $item)                
                            @if($count == 4)
                                </div><div class="divide10"></div><div class="row">
                            @endif
                            <div class="col-sm-3" style="min-height:300px;">
                                <div class="caption-overlay">
                                    <figure style="margin-bottom:10px;">
                                        <a class="fancybox-media" data-rel="{{$key}}" href="{{$item->cover()}}" rel="{{$key}}">
                                            <img style="height:179px !important;" width="270" src="{{$item->cover()}}" alt="{{$item->titulo}}"> 
                                        </a>
                                    </figure>
                                    <p style="text-align:center;">
                                        <span style="text-transform: uppercase;"><strong>{{$item->titulo}}</strong></span><br />
                                        {!!$item->content!!}
                                    </p>
                                </div>
                                @if ($item->images()->get()->count())
                                    @foreach($item->images()->get() as $imagem)
                                        <a class="cbp-caption fancybox-media" data-rel="{{$key}}" href="{{ $imagem->url_image }}" rel="{{$key}}">
                                            <img style="display:none;" src="{{ $imagem->url_image }}">
                                        </a>
                                    @endforeach  
                                @endif 
                            </div>                            
                            @php $count++; @endphp
                        @endforeach
                        
                    </div>  
                    <div class="row">
                        <div class="col-12">
                            {{$galerias->links()}} 
                        </div>    
                    </div>                           
                </div>  
            </div>  
        </section>
    @endif

@endsection

@section('css')
    <style>
        .navbar {
            background: rgba(29,29,33,0.8) !important;
            height: 70px;
        }
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
    </style>
@endsection

@section('js')

@endsection