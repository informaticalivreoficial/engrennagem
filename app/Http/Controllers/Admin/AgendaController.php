<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AgendaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $eventos = Agenda::orderBy('data', 'DESC')->paginate(25);
        return view('admin.agenda.index', ['eventos' => $eventos]);
    }

    public function create(Request $request)
    {        
        return view('admin.agenda.create');
    }

    public function store(AgendaRequest $request)
    {
        $eventoCreate = Agenda::create($request->all());
        $eventoCreate->fill($request->all());

        if(!empty($request->hasFile('thumb'))){
            $eventoCreate->thumb = $request->file('thumb')->storeAs(env('AWS_PASTA') . 'agenda', 
            Str::slug($request->titulo)  . '-' . str_replace('.',
             '', microtime(true)) . '.' . $request->file('thumb')->extension());
        }

        $eventoCreate->setUrl();        
        
        return redirect()->route('agenda.edit', $eventoCreate->id)->with([
            'color' => 'success', 
            'message' => 'Evento cadastrado com sucesso!'
        ]);
    }

    public function edit($id)
    {
        $evento = Agenda::where('id', $id)->first();                
        return view('admin.agenda.edit', ['evento' => $evento]);
    }

    public function update(AgendaRequest $request, $id)
    {
        $evento = Agenda::where('id', $id)->first();        

        if(!empty($request->hasFile('thumb'))){
            Storage::delete($evento->thumb);
            $evento->thumb = '';
        }

        $evento->fill($request->all());

        if(!empty($request->hasFile('thumb'))){
            $evento->thumb = $request->file('thumb')->storeAs(env('AWS_PASTA') . 'agenda', 
            Str::slug($request->name)  . '-' . str_replace('.',
             '', microtime(true)) . '.' . $request->file('thumb')->extension());
        }

        $evento->save();
        $evento->setUrl();
        
        return redirect()->route('agenda.edit', [
            'id' => $evento->id,
        ])->with(['color' => 'success', 'message' => 'Agenda atualizada com sucesso!']);
    }

    public function agendaSetStatus(Request $request)
    {        
        $evento = Agenda::find($request->id);
        $evento->status = $request->status;
        $evento->save();
        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $eventodelete = Agenda::where('id', $request->id)->first();
        $nome = \App\Helpers\Renato::getPrimeiroNome(Auth::user()->name);

        if(!empty($eventodelete)){
            $json = "<b>$nome</b> você tem certeza que deseja excluir este evento?";
            return response()->json(['error' => $json,'id' => $eventodelete->id]);            
        }else{
            return response()->json(['error' => 'Erro ao excluir']);
        }       
    }

    public function deleteon(Request $request)
    {
        $eventodelete = Agenda::where('id', $request->evento_id)->first();  
        $postR = $eventodelete->titulo;

        if(!empty($eventodelete)){            
            //Remove Thumb
            Storage::delete($eventodelete->thumb);
            $eventodelete->delete();
        }

        return redirect()->route('agenda.index')->with([
            'color' => 'success', 
            'message' => 'O evento '.$postR.' foi removido com sucesso!'
        ]);        
    }
}
