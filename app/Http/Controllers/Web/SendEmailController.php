<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Renato;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Web\Atendimento;
use App\Mail\Web\AtendimentoRetorno;
use App\Models\Newsletter;
use App\Models\NewsletterCat;
use App\Models\User;
use App\Services\CidadeService;
use App\Services\ConfigService;
use App\Services\EstadoService;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SendEmailController extends Controller
{
    protected $configService, $estadoService, $cidadeService;

    public function __construct(
        ConfigService $configService, 
        EstadoService $estadoService, 
        CidadeService $cidadeService)
    {
        $this->configService = $configService;
        $this->cidadeService = $cidadeService;
        $this->estadoService = $estadoService;
    }

    public function sendEmail(Request $request)
    {
        if($request->nome == ''){
            $json = "Por favor preencha o campo <strong>Nome</strong>";
            return response()->json(['error' => $json]);
        }
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json = "O campo <strong>Email</strong> está vazio ou não tem um formato válido!";
            return response()->json(['error' => $json]);
        }
        if($request->mensagem == ''){
            $json = "Por favor preencha sua <strong>Mensagem</strong>";
            return response()->json(['error' => $json]);
        }
        if(!empty($request->bairro) || !empty($request->cidade)){
            $json = "<strong>ERRO</strong> Você está praticando SPAM!"; 
            return response()->json(['error' => $json]);
        }else{
            $data = [
                'sitename' => $this->configService->getConfig()->nomedosite,
                'siteemail' => $this->configService->getConfig()->email,
                'reply_name' => $request->nome,
                'reply_email' => $request->email,
                'mensagem' => $request->mensagem
            ];

            $retorno = [
                'sitename' => $this->configService->getConfig()->nomedosite,
                'siteemail' => $this->configService->getConfig()->email,
                'reply_name' => $request->nome,
                'reply_email' => $request->email
            ];
            
            Mail::send(new Atendimento($data));
            Mail::send(new AtendimentoRetorno($retorno));
            
            $json = "Obrigado {$request->nome} sua mensagem foi enviada com sucesso!"; 
            return response()->json(['sucess' => $json]);
        }
    }

    public function sendNewsletter(Request $request)
    {
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json = "O campo <strong>Email</strong> está vazio ou não tem um formato válido!";
            return response()->json(['error' => $json]);
        }
        if(!empty($request->bairro) || !empty($request->cidade)){
            $json = "<strong>ERRO</strong> Você está praticando SPAM!";  
            return response()->json(['error' => $json]);
        }else{   
            $validaNews = Newsletter::where('email', $request->email)->first();            
            if(!empty($validaNews)){
                Newsletter::where('email', $request->email)->update(['status' => 1]);
                $json = "Obrigado Cadastro realizado com sucesso!"; 
                return response()->json(['sucess' => $json]);
            }else{
                $categoriaPadrão = NewsletterCat::where('sistema', 1)->first();                
                $data = $request->all();
                $data['autorizacao'] = 1;
                $data['categoria'] = $categoriaPadrão->id;
                $data['nome'] = $request->nome ?? '#Cadastrado pelo Site';
                $NewsletterCreate = Newsletter::create($data);
                $NewsletterCreate->save();
                $json = "Obrigado Cadastrado com sucesso!"; 
                return response()->json(['sucess' => $json]);
            }            
        }
    }    
}
