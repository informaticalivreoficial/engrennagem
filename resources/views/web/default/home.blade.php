@extends("web.{$configuracoes->template}.master.master")

@section('content')

<section id="inicio">
    <div class="tp-fullscreen-container revolution">
        @if (!empty($slides) && $slides->count() > 0)
            <div class="tp-fullscreen">
                <ul>
                    @foreach ($slides as $key => $slide)                        
                        @if ($slide->link != null)
                            <li data-transition="fade" data-link="{{$slide->link}}" {{($slide->target == 1 ? 'target="_blank"' : '')}}>                    
                                <img src="{{$slide->getimagem()}}"  alt="{{$slide->titulo}}" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />                            
                            </li>                                
                        @else 
                            <li data-transition="fade"> 
                                <img src="{{$slide->getimagem()}}"  alt="{{$slide->titulo}}" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
                            </li>                  
                        @endif                
                    @endforeach 
                </ul>
            </div>
        @endif 
    </div>  
</section>

@if (!empty($eventos) && $eventos->count() > 0)
    <section id="agenda" style="padding-top: 70px; margin-top: -70px;"> 
        <div class="light-wrapper" style="background-image: url({{url('frontend/'.$configuracoes->template.'/assets/images/agendabg.png')}});color:#000;background-repeat:no-repeat;background-size:cover;background-position:center;">
            <div class="container inner" style="padding-top:50px;">
                <div class="divide10"></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pricing panel" style="background-color: transparent;border:none;">
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                    @foreach($eventos as $evento)
                                        <tr>
                                            <td style="padding:0px;border:none;">
                                                <p style="margin:15px 0 2px 0;font-size: 20px;text-transform: uppercase;text-align:center;">
                                                <span style="font-size: 28px;">{{ date('d', strtotime($evento->data)) }}</span><br />
                                                {{ Carbon\Carbon::parse($evento->data)->formatLocalized('%b') }}</p>
                                            </td>
                                            <td style="padding:0px;border:none;">
                                                <p style="margin:15px 0 2px 0;line-height:24px;text-align:left;font-size: 20px;"><strong>{{$evento->titulo}}</strong><br />
                                                <span style="font-size:14px;">{{$evento->endereco}}</span></p> 
                                            </td>
                                            <td style="padding:0px;border:none;">
                                                <p style="margin:15px 0 2px 0;">
                                                    <a target="_blank" href="{{$evento->link ?? '#'}}" class="btn btn btn-red j_info">+ INFO</a>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if (!empty($discografia) && $discografia->count() > 0)
    <section id="discografia"> 
        <div class="light-wrapper" style="background-image: url({{url('frontend/'.$configuracoes->template.'/assets/images/discografiabg.png')}});color:#000;background-repeat:no-repeat;background-size:cover;background-position:center;padding-top: 100px;padding-bottom: 50px;">
            <div class="container inner" >
                <div class="divide10"></div> 
                <div class="row" >  
                    @foreach($discografia as $disco)  
                        <div class="col-sm-4" style="padding-top:26px;">                      
                            <div style="text-align:center !important;margin-left:35px !important;">                      
                                <div class="col-sm-2 col-xs-2" style="padding:0 9px 10px 5px;text-align:center;">
                                    @if($disco->deezer)
                                        <a style="padding:10px" title="Deezer" href="{{$disco->deezer}}" target="_blank">
                                            <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/deezer.png')}}" alt="{{url('frontend/'.$configuracoes->template.'/assets/images/deezer.png')}}" />
                                        </a>
                                    @endif
                                </div>                      
                                <div class="col-sm-2 col-xs-2" style="padding:0 9px 10px 5px;text-align:center;">
                                    @if($disco->music)
                                        <a style="padding:10px" title="Music" href="{{$disco->music}}" target="_blank">
                                            <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/music.png')}}" alt="{{url('frontend/'.$configuracoes->template.'/assets/images/music.png')}}" />
                                        </a>
                                    @endif
                                </div>                      
                                <div class="col-sm-2 col-xs-2" style="padding:0 9px 10px 5px;text-align:center;">
                                    @if($disco->spotify)
                                        <a style="padding:10px" title="Spotify" href="{{$disco->spotify}}" target="_blank">
                                            <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/spotify.png')}}" alt="{{url('frontend/'.$configuracoes->template.'/assets/images/spotify.png')}}" />
                                        </a>
                                    @endif
                                </div>                      
                                <div class="col-sm-2 col-xs-2" style="padding:0 9px 10px 5px;text-align:center;">
                                    @if($disco->itunes)
                                        <a style="padding:10px" title="Itunes" href="{{$disco->itunes}}" target="_blank">
                                            <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/itunes.png')}}" alt="{{url('frontend/'.$configuracoes->template.'/assets/images/itunes.png')}}" />
                                        </a>
                                    @endif
                                </div>                      
                                <div class="col-sm-2 col-xs-2" style="padding:0 9px 10px 5px;text-align:center;">
                                    @if($disco->apple_music)
                                        <a style="padding:10px" title="Apple Music" href="{{$disco->apple_music}}" target="_blank">
                                            <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/applemusic.png')}}" alt="{{url('frontend/'.$configuracoes->template.'/assets/images/applemusic.png')}}" />
                                        </a>
                                    @endif
                                </div>
                            </div>                      
                      
                            <a class="fancybox-media" data-rel="4{{$disco->id}}" href="{{$disco->cover()}}" rel="4{{$disco->id}}">
                                <img src="{{$disco->cover()}}" alt="{{$disco->titulo}}">
                            </a>
                      
                            <p class="discografiap">
                                @if($disco->ficha_tecnica)
                                        <a class="fancybox-media" data-rel="2{{$disco->id}}" href="#2{{$disco->id}}" rel="2{{$disco->id}}">
                                            <span>Ficha Técnica</span>
                                        </a>
                                @endif
                                @if($disco->letras)
                                    <a class="fancybox-media" data-rel="3{{$disco->id}}" href="#3{{$disco->id}}" rel="3{{$disco->id}}">
                                        <span>Letras</span>
                                    </a>
                                @endif
                                @if($disco->link)
                                    <a target="_blank" href="{{$disco->link}}">
                                        <span>Ouça o CD</span>
                                    </a>
                                @endif                    
                            </p>
                        </div>
  
                        <div class="col-sm-12" id="2{{$disco->id}}" style="display:none;">{!!$disco->ficha_tecnica!!}</div>
                        <div class="col-sm-12" id="3{{$disco->id}}" style="display:none;">{{$disco->letras}}</div>
                        <img style="display:none;" src="{{$disco->cover()}}" alt="{{$disco->titulo}}">
                    @endforeach
                </div>
            </div>  
        </div>  
    </section>    
@endif

@if (!empty($videos) && $videos->count() > 0)
    <section id="videos">
        <div class="light-wrapper">
            <div class="container inner">
                <div class="divide10"></div>            
                <div class="row">                          
                    @foreach($videos as $key => $video)                                
                        <div class="col-sm-3" style="padding-top:20px;">
                            <div class="caption-overlay"> 
                                <figure>
                                    <a class="cbp-caption fancybox-media" data-rel="1{{$video->id}}" href="#1{{$video->id}}" rel="1{{$video->id}}">
                                        <img src="{{\App\Helpers\Renato::imagemYouTube($video->url)}}" alt="{{$video->titulo}}">
                                    </a>
                                </figure>
                                <div class="caption bottom-right" style="bottom: 43%;">
                                    <div class="title" style="width:100%;text-align:center;">
                                        <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/youtube-btn.png')}}" />
                                    </div>
                                </div>
                            </div>
                        </div>                                
                        <div class="col-sm-12" id="1{{$video->id}}" style="display:none;"> 
                            <iframe src="{{$video->embed}}" frameborder="0" allowfullscreen height="360" width="460"></iframe>            
                        </div>
                    @endforeach    
                    <div class="divide10"></div>   
                    @if ($configuracoes->youtube)
                        <div class="col-sm-12" id="link-inscrevase" style="padding-top:20px;text-align: center;">            
                            <h3><a href="{{$configuracoes->youtube}}" target="_blank">INSCREVA-SE EM NOSSO CANAL</a> &nbsp;&nbsp;<img src="{{url('frontend/'.$configuracoes->template.'/assets/images/youtube-btn1.png')}}" /></h3>            
                        </div>
                    @endif 
                </div>
            </div>
        </div>    
    </section>
@endif   

@if (!empty($galerias) && $galerias->count() > 0)
    <section id="fotos"> 
        <div class="light-wrapper">  
            <div class="container inner">
                <div class="divide10"></div>
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
                        </div>
                        @if ($item->images()->get()->count())
                            @foreach($item->images()->get() as $imagem)
                                <a class="cbp-caption fancybox-media" data-rel="{{$key}}" href="{{ $imagem->url_image }}" rel="{{$key}}">
                                    <img style="display:none;" src="{{ $imagem->url_image }}">
                                </a>
                            @endforeach  
                        @endif 
                        @php $count++; @endphp
                    @endforeach
                </div>             
            </div>  
        </div>  
    </section>
@endif

@if (!empty($arquivos) && $arquivos->count() > 0)
    <section id="contratante" style="padding-top: 70px; margin-top: -70px;"> 
        <div class="light-wrapper" style="background-image: url({{url('frontend/'.$configuracoes->template.'/assets/images/contratante-bg.png')}});color:#000;background-repeat:no-repeat;background-size: cover;background-position:center;">
            <div class="container inner"> 
                <div class="divide10"></div>    
                <div class="row">
                    <div class="col-sm-12" style="text-align: center;">
                        <h1 style="text-shadow: 1px 1px 1px #000;color: #ddd;">ÁREA DO CONTRATANTE</h1>
                    </div>    
                    <div class="divide10"></div>
                    @foreach($arquivos as $arquivo)
                        <div class="col-sm-3" style="padding-top:20px;">
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($arquivo->arquivo) }}">
                                <img src="{{$arquivo->cover()}}" alt="{{$arquivo->titulo}}">
                            </a>
                        </div>
                    @endforeach
                </div>  
            </div>
        </div>    
    </section>   
@endif

<section id="contato">
    <div class="light-wrapper" style="background-image: url({{url('frontend/'.$configuracoes->template.'/assets/images/contact-bg.jpg')}});color:#000;background-repeat:no-repeat;background-size: cover;background-position:center;">  
        <div class="container inner">   
            <div class="divide10"></div>  
            <div class="row">
                <div class="col-sm-12" style="margin-bottom: 50px;"> 
                    
                </div>   
            </div>
  
            <div class="divide10"></div>
  
            <div class="row">
                <div class="col-sm-4">
                    @if ($configuracoes->facebook)
                        <div class="fb-page" data-href="{{$configuracoes->facebook}}" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="{{$configuracoes->facebook}}" class="fb-xfbml-parse-ignore">
                                <a href="{{$configuracoes->facebook}}">Engrennagem</a>
                            </blockquote>
                        </div>
                    @endif                    
                </div>    
                <div class="col-sm-4">
                    @if ($configuracoes->twitter)
                        <a class="twitter-timeline" href="{{$configuracoes->twitter}}" height="359">Tweets by Engrennagem</a>
                        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    @endif                    
                </div>    
                <div class="col-sm-4">    
                
                </div>
            </div>
  
            <div class="divide10"></div>
  
            <div class="row">
                <div class="col-sm-8" id="fundo-youtube">
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <div class="g-ytsubscribe" data-channelid="UCB_RfNRIJNnrzwsbfJXvG4w" data-layout="full" data-theme="dark" data-count="default"></div>
                </div>    
                <div class="col-sm-4">
                    <iframe width="100%" height="110" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/38680885&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
                </div>
            </div>  

            @if (!empty($parceiros) && $parceiros->count() > 0)
                <div class="divide10"></div>
                <div class="row">
                    <div class="col-sm-12" style="margin-top: 30px;">
                        <h2 style="text-align:center">Parceiros</h2>            
                    </div>
                </div>
                <div class="divide10"></div>
                <div class="row">
                    @foreach($parceiros as $parceiro)
                        <div class="col-sm-2">
                            <div class="caption-overlay">
                                <figure style="margin-bottom:10px;">
                                    @if($parceiro->link == '')
                                        <a class="fancybox-media" href="#"> 
                                    @else
                                        <a class="fancybox-media" target="_blank" href="{{$parceiro->link}}"> 
                                    @endif
                                    <img src="{{$parceiro->cover()}}" alt="{{$parceiro->name}}">                                  
                                    </a>
                                </figure>                         
                            </div>
                        </div>           
                    @endforeach
                </div>
            @endif         
        </div>
    </div>  
</section> 


<div class="dialog">
    <div class="loadsistem">        
        <header class="dialog-topo">
            <h3><strong>&nbsp;</strong></h3>
            <p>&nbsp;</p>
        </header>
        <fieldset>
            <section>            
                <div class="row">
                    <div class="col-sm-12 formmodal">
                        <form class="j_formsubmit" method="post" action="" autocomplete="off">
                            @csrf
                            <div class="row  wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="300ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                    <div id="js-contact-result"></div>
                                    <!-- HONEYPOT -->
                                    <input type="hidden" class="noclear" name="bairro" value="" />
                                    <input type="text" class="noclear" style="display: none;" name="cidade" value="" />
                                </div>
                
                                <div class="form_hide">
                                    <div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" name="nome" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="email" name="email" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 col-lg-4">
                                        <div class="form-group">
                                            <label>WhatsApp</label>
                                            <input type="text" name="numero"  class="form-control whatsapp"/>
                                        </div>
                                    </div> 
                                </div>
                
                                <div class="clearfix"></div>
                                <div class="col-md-6 col-sm-6 col-xs-6 hiddemmodal">
                                    &nbsp;
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group modalfooter">
                                        <button type="button" class="modal-btn btnfechar">Fechar &nbsp;<strong></strong></button>
                                    </div>
                                </div>
                                <div class="form_hide">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group modalfooter">
                                        <button type="submit" style="width: 100%;" class="modal-btn btnsuccess btncheckout">Cadastrar<strong> :)</strong></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>   
                    </div>            
                </div>	
			</section>
        </fieldset>
    </div>
</div> 
@endsection

@section('css')
    
@endsection

@section('js')
<script src="{{url(asset('backend/assets/js/jquery.mask.js'))}}"></script>
<script>

    $(document).ready(function () { 
        var $whatsapp = $(".whatsapp");
        $whatsapp.mask('(99) 99999-9999', {reverse: false});
    });

    $(function () {

        // $(".j_info").click(function(){
        //     $.post("{{ route('web.addCountAgenda') }}", {val:'1'}).done(function(response){
        //         alert("success");
        //         console.log(response.success);
        //     });
        // });

        $('.modalcadastro').click(function (){
            $('.dialog').css('display','block');
        });
        
        $('.btnfechar').click(function (){
            $('.dialog').modal().hide();
        });

        // Seletor, Evento/efeitos, CallBack, Ação
        $('.j_formsubmit').submit(function (){
            var form = $(this);
            var dataString = $(form).serialize();

            $.ajax({
                url: "{{ route('web.sendWhatsapp') }}",
                data: dataString,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    form.find(".btncheckout").attr("disabled", true);
                    form.find('.btncheckout').html("Carregando...");                
                    form.find('.alert').fadeOut(500, function(){
                        $(this).remove();
                    });
                },
                success: function(resposta){
                    $('html, body').animate({scrollTop:$('#js-contact-result').offset().top-100}, 'slow');
                    if(resposta.error){
                        form.find('#js-contact-result').html('<div class="alert alert-danger error-msg">'+ resposta.error +'</div>');
                        form.find('.error-msg').fadeIn();                    
                    }else{
                        form.find('#js-contact-result').html('<div class="alert alert-success error-msg">'+ resposta.sucess +'</div>');
                        form.find('.error-msg').fadeIn();                    
                        form.find('input[class!="noclear"]').val('');
                        form.find('textarea[class!="noclear"]').val('');
                        form.find('.form_hide').fadeOut(500);
                    }
                },
                complete: function(resposta){
                    form.find(".btncheckout").attr("disabled", false);
                    form.find('.btncheckout').html("Cadastrar Agora &nbsp;<strong>:)</strong>");                                
                }
            });
            return false;
        });

    });
   
</script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=1787040554899561";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>  
@endsection