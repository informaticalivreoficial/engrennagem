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
                            @if($key == 4)
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
                            @php $key++; @endphp
                        @endforeach
                        {{$galerias->links()}} 
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
    </style>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script>
    // Paginação infinita
    $('ul.pagination-custom').hide();
    $(function() {
        $('.scrolling-pagination').jscroll({
            autoTrigger: true,
            padding: 0,
            nextSelector: '.pagination-custom li.active + li a',
            contentSelector: 'div.scrolling-pagination',
            callback: function() {
                $('ul.pagination-custom').remove();
            }
        });
    }); 
</script>
@endsection