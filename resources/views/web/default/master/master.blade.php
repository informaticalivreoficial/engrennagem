<!DOCTYPE html>
<html lang="pt-br">
<head>	
    <meta charset="utf-8"/>    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="language" content="pt-br" /> 
    <meta name="author" content="{{env('DESENVOLVEDOR')}}"/>
    <meta name="designer" content="Renato Montanari">
    <meta name="publisher" content="Renato Montanari">
    <meta name="url" content="{{$configuracoes->dominio}}" />
    <meta name="keywords" content="{{$configuracoes->metatags}}">
    <meta name="distribution" content="web">
    <meta name="rating" content="general">
    <meta name="date" content="Dec 26">
    <meta name="google-site-verification" content="LqBkQawC_hN5jiisQ5S2WXVkDVgpvicjUV2KC86dLQs" />

    {!! $head ?? '' !!}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS -->
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/plugins.css')}}" rel="stylesheet"/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/style.css')}}" rel="stylesheet"/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/blue.css')}}" rel="stylesheet"/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/renato.css')}}" rel="stylesheet"/>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'/>
    <link href='https://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic' rel='stylesheet' type='text/css'/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/type/icons.css')}}" rel="stylesheet"/>
    <link href="{{url('frontend/'.$configuracoes->template.'/assets/css/jquery-ui.css')}}" rel="stylesheet"/>
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{$configuracoes->getfaveicon()}}"/>

    @hasSection('css')
        @yield('css')
    @endif
 </head>
 <body>

    <main class="body-wrapper">
        <div class="navbar">
            <div class="navbar-header">
                <div class="basic-wrapper"> 
                    <div class="navbar-brand"> 
                        <a href="{{route('web.home')}}">
                            <img src="{{$configuracoes->getLogomarca()}}" class="logo-light" alt="{{$configuracoes->nomedosite}}" />
                            <img src="{{$configuracoes->getLogomarca()}}" class="logo-dark" alt="{{$configuracoes->nomedosite}}" />
                        </a> 
                    </div>
                    <a class="btn responsive-menu" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
                </div> 
            </div>
            <nav class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#inicio">HOME</a></li>
                    <li><a href="#agenda">AGENDA</a></li>
                    <li><a href="#discografia">DISCOGRAFIA</a></li>
                    <li><a href="#videos">VÍDEOS</a></li>
                    <li><a href="#fotos">FOTOS</a></li>
                    <li><a href="#contratante">CONTRATANTE</a></li>
                    <li><a href="#contato">CONTATO</a></li>
                    <li><a class="modalcadastro" href="#">CADASTRE-SE</a></li>
                </ul>
            </nav>            
            <div class="social-wrapper">
                <ul class="social naked">
                    @if ($configuracoes->facebook)
                        <li>
                            <a target="_blank" href="{{$configuracoes->facebook}}" title="Facebook">
                                <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-facebook.png')}}" alt="Facebook" width="16" />
                            </a>
                        </li>
                    @endif
                    @if ($configuracoes->twitter)
                        <li>
                            <a target="_blank" href="{{$configuracoes->twitter}}" title="Twitter">
                                <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-twitter.png')}}" alt="Twitter" width="16" />
                            </a>
                        </li>
                    @endif
                    @if ($configuracoes->instagram)
                        <li>
                            <a target="_blank" href="{{$configuracoes->instagram}}" title="Instagram">
                                <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-instagran.png')}}" alt="Instagram" width="16" />
                            </a>
                        </li>
                    @endif
                    @if ($configuracoes->spotify)
                        <li>
                            <a target="_blank" href="{{$configuracoes->spotify}}" title="Spotify">
                                <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-spotify.png')}}" alt="Spotify" width="16" />
                            </a>
                        </li>
                    @endif
                    @if ($configuracoes->youtube)
                        <li>
                            <a target="_blank" href="{{$configuracoes->youtube}}" title="Youtube">
                                <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-youtube.png')}}" alt="Youtube" width="16" />
                            </a>
                        </li>
                    @endif
                    @if ($configuracoes->soundclound)
                        <li>
                            <a target="_blank" href="{{$configuracoes->soundclound}}" title="SoundCloud">
                                <img src="{{url('frontend/'.$configuracoes->template.'/assets/images/icon-soundcloud.png')}}" alt="SoundCloud" width="16" />
                            </a>
                        </li>
                    @endif                    
                </ul>
            </div>
        </div>

        <!-- INÍCIO DO CONTEÚDO DO SITE -->
        @yield('content')
        <!-- FIM DO CONTEÚDO DO SITE --> 

        <footer class="footer inverse-wrapper">
            <div class="sub-footer">
                <div class="container inner">
                    <p class="text-center">© {{$configuracoes->ano_de_inicio}} - {{date('Y')}} {{$configuracoes->nomedosite}}. Todos os direitos reservados. <a href="{{route('web.politica')}}">Política de Privacidade</a></p>
                    
                    
                </div>
            </div>
        </footer>
    </main>   
     
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.min.js')}}"></script> 
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/bootstrap.min.js')}}"></script> 
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/plugins.js')}}"></script> 
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/classie.js')}}"></script> 
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.themepunch.tools.min.js')}}"></script> 
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/scripts.js')}}"></script>
    <script src="{{url('frontend/'.$configuracoes->template.'/assets/js/jquery-ui.js')}}"></script> 

    <script>
        $(function () {    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    @hasSection('js')
        @yield('js')
    @endif    

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$configuracoes->tagmanager_id}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', '{{$configuracoes->tagmanager_id}}');
    </script>
</body>
</html>