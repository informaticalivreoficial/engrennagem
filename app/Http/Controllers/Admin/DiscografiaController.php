<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DiscografiaRequest;
use App\Models\Discografia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DiscografiaController extends Controller
{
    public function index()
    {
        $discos = Discografia::orderBy('created_at', 'DESC')->paginate(25);
        return view('admin.discografia.index', ['discos' => $discos]);
    }

    public function create(Request $request)
    {        
        return view('admin.discografia.create');
    }

    public function store(DiscografiaRequest $request)
    {
        $discoCreate = Discografia::create($request->all());
        $discoCreate->fill($request->all());

        if(!empty($request->hasFile('thumb'))){
            $discoCreate->thumb = $request->file('thumb')->storeAs(env('AWS_PASTA') . 'discografia', 
            Str::slug($request->titulo)  . '-' . str_replace('.',
             '', microtime(true)) . '.' . $request->file('thumb')->extension());
        }

        $discoCreate->setSlug();        
        
        return redirect()->route('discografia.edit', $discoCreate->id)->with([
            'color' => 'success', 
            'message' => 'Disco cadastrado com sucesso!'
        ]);
    }

    public function edit($id)
    {
        $disco = Discografia::where('id', $id)->first();                
        return view('admin.discografia.edit', ['disco' => $disco]);
    }

    public function update(DiscografiaRequest $request, $id)
    {
        $disco = Discografia::where('id', $id)->first();        

        if(!empty($request->hasFile('thumb'))){
            Storage::delete($disco->thumb);
            $disco->thumb = '';
        }

        $disco->fill($request->all());

        if(!empty($request->hasFile('thumb'))){
            $disco->thumb = $request->file('thumb')->storeAs(env('AWS_PASTA') . 'discografia', 
            Str::slug($request->name)  . '-' . str_replace('.',
             '', microtime(true)) . '.' . $request->file('thumb')->extension());
        }

        $disco->save();
        $disco->setUrl();
        
        return redirect()->route('discografia.edit', [
            'id' => $disco->id,
        ])->with(['color' => 'success', 'message' => 'Disco atualizado com sucesso!']);
    }

    public function discografiaSetStatus(Request $request)
    {        
        $disco = Discografia::find($request->id);
        $disco->status = $request->status;
        $disco->save();
        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $discodelete = Discografia::where('id', $request->id)->first();
        $nome = \App\Helpers\Renato::getPrimeiroNome(Auth::user()->name);

        if(!empty($discodelete)){
            $json = "<b>$nome</b> você tem certeza que deseja excluir este Disco?";
            return response()->json(['error' => $json,'id' => $discodelete->id]);            
        }else{
            return response()->json(['error' => 'Erro ao excluir']);
        }       
    }

    public function deleteon(Request $request)
    {
        $discodelete = Discografia::where('id', $request->disco_id)->first();  
        $postR = $discodelete->titulo;

        if(!empty($discodelete)){            
            //Remove Thumb
            Storage::delete($discodelete->thumb);
            $discodelete->delete();
        }

        return redirect()->route('discografia.index')->with([
            'color' => 'success', 
            'message' => 'O disco '.$postR.' foi removido com sucesso!'
        ]);        
    }
}
