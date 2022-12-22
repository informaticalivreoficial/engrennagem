<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArquivoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Arquivo;
use Illuminate\Http\Request;

class ArquivoController extends Controller
{
    public function index()
    {
        $arquivos = Arquivo::orderBy('created_at', 'DESC')->paginate(25);
        return view('admin.arquivos.index', ['arquivos' => $arquivos]);
    }

    public function create(Request $request)
    {        
        return view('admin.arquivos.create');
    }

    public function store(ArquivoRequest $request)
    {
        $arquivoCreate = Arquivo::create($request->all());
        $arquivoCreate->fill($request->all());

        if(!empty($request->hasFile('thumb'))){
            $arquivoCreate->thumb = $request->file('thumb')->storeAs(env('AWS_PASTA') . 'arquivos', 
            Str::slug($request->titulo)  . '-' . str_replace('.',
             '', microtime(true)) . '.' . $request->file('thumb')->extension());
        }

        $arquivoCreate->setSlug();        
        
        return redirect()->route('arquivos.edit', $arquivoCreate->id)->with([
            'color' => 'success', 
            'message' => 'Arquivo cadastrado com sucesso!'
        ]);
    }

    public function edit($id)
    {
        $arquivo = Arquivo::where('id', $id)->first();                
        return view('admin.arquivos.edit', ['arquivo' => $arquivo]);
    }

    public function update(ArquivoRequest $request, $id)
    {
        $arquivo = Arquivo::where('id', $id)->first();        

        if(!empty($request->hasFile('thumb'))){
            Storage::delete($arquivo->thumb);
            $arquivo->thumb = '';
        }

        $arquivo->fill($request->all());

        if(!empty($request->hasFile('thumb'))){
            $arquivo->thumb = $request->file('thumb')->storeAs(env('AWS_PASTA') . 'arquivos', 
            Str::slug($request->titulo)  . '-' . str_replace('.',
             '', microtime(true)) . '.' . $request->file('thumb')->extension());
        }

        if(!empty($request->hasFile('arquivo'))){
            $arquivo->arquivo = $request->file('arquivo')->storeAs(env('AWS_PASTA') . 'arquivos', 
            Str::slug($request->titulo)  . '-' . str_replace('.',
             '', microtime(true)) . '.' . $request->file('arquivo')->extension());
        }

        $arquivo->save();
        $arquivo->setSlug();
        
        return redirect()->route('arquivos.edit', [
            'id' => $arquivo->id,
        ])->with(['color' => 'success', 'message' => 'Arquivo atualizado com sucesso!']);
    }

    public function setStatus(Request $request)
    {        
        $arquivo = Arquivo::find($request->id);
        $arquivo->status = $request->status;
        $arquivo->save();
        return response()->json(['success' => true]);
    }
}
