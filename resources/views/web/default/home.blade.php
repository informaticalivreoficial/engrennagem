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
                                    <a class="cbp-caption fancybox-media" data-rel="1'.$video['id'].'" href="#1'.$video['id'].'" rel="1'.$video['id'].'">
                                        <img src="'.imagemYouTube($video['link']).'" alt="'.$video['titulo'].'">
                                    </a>
                                </figure>
                                <div class="caption bottom-right" style="bottom: 43%;">
                                    <div class="title" style="width:100%;text-align:center;">
                                        <img src="'.PATCH.'/images/youtube-btn.png" />
                                    </div>
                                </div>
                            </div>
                        </div>                                
                        <div class="col-sm-12" id="1'.$video['id'].'" style="display:none;"> 
                            <iframe src="'.$video['embed'].'" frameborder="0" allowfullscreen height="360" width="460"></iframe>            
                        </div>
                    @endforeach    
                    <div class="divide10"></div>   
                    @if ($configuracoes->youtube)
                        <div class="col-sm-12" id="link-inscrevase" style="padding-top:20px;text-align: center;">            
                            <h3><a href="{{$configuracoes->youtube}}" target="_blank">INSCREVA-SE EM NOSSO CANAL</a> &nbsp;&nbsp;<img src="{{url('frontend/assets//images/youtube-btn1.png')}}" /></h3>            
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

                        <div class="col-sm-3" style="min-height:290px;">
                            <div class="caption-overlay">
                                <figure style="margin-bottom:10px;">
                                    <a class="fancybox-media" data-rel="{{$key}}" href="{{$item->cover()}}" rel="{{$key}}">
                                        <img height="285" src="{{$item->cover()}}" alt="{{$item->titulo}}"> 
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

<section id="contato">
    <div class="light-wrapper" style="background-image: url({{url('frontend/assets/images/contact-bg.jpg')}});color:#000;background-repeat:no-repeat;background-size: cover;background-position:center;">  
        <div class="container inner">   
            <div class="divide10"></div>  
            <div class="row">
                <div class="col-sm-12" style="margin-bottom: 50px;"> 
                    
                </div>   
            </div>
  
            <div class="divide10"></div>
  
            <div class="row">
                <div class="col-sm-4">
                    <div class="fb-page" data-href="<?= FACEBOOK;?>" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="<?= FACEBOOK;?>" class="fb-xfbml-parse-ignore">
                            <a href="<?= FACEBOOK;?>">Engrennagem</a>
                        </blockquote>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <a class="twitter-timeline" href="<?= TWITTER;?>" height="359">Tweets by Engrennagem</a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
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
  
        
         <?php
             $readParceiros = read('parceiros',"WHERE status = '1' ORDER BY data DESC");
             foreach($readParceiros as $parceiro1);
             if($parceiro1){
                  echo '
                  <div class="divide10"></div>
                     <div class="row">
                          <div class="col-sm-12" style="margin-top: 30px;">
                              <h2 style="text-align:center">Parceiros</h2>            
                          </div>
                     </div>
                     
                     
                     <div class="divide10"></div>
                    <div class="row">
                  ';
                  foreach($readParceiros as $parceiro):
                      echo '
                      <div class="col-sm-2">
                        <div class="caption-overlay">
                          <figure style="margin-bottom:10px;">
                      ';
                      if($parceiro['link'] == ''){
                         echo '<a class="fancybox-media" href="#">'; 
                      }else{
                         echo '<a class="fancybox-media" target="_blank" href="'.$parceiro['link'].'">'; 
                      }
                      $pasta 	= ''.BASE.'/uploads/parceiros/';
                      if(file_exists($pasta.$parceiro['img']) && !is_dir($pasta.$parceiro['img'])){
                          echo '<img src="'.PATCH.'/images/image.jpg" alt="'.$parceiro['nome'].'">';
                      }else{
                          echo '<img src="'.BASE.'/uploads/parceiros/'.$parceiro['img'].'" alt="'.$parceiro['nome'].'" title="'.$parceiro['nome'].'">';
                      }
                      echo '    
                           </a>
                          </figure>                         
                        </div>
                      </div>
                      ';                
                  endforeach;
                  echo '
                  </div>
                  ';
             }
  
          ?> 
  
      </div>
    </div>
  
</section> 

@endsection

@section('css')
    
@endsection

@section('js')
  
@endsection