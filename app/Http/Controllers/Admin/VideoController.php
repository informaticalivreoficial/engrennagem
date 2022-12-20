<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('status', 'ASC')
                ->orderBy('created_at', 'DESC')
                ->paginate(25);
        return view('admin.videos.index', [
            'videos' => $videos
        ]);
    }

    public function create()
    {
        $videos = Video::orderBy('titulo', 'ASC')->get();
        return view('admin.videos.create',[
            'videos' => $videos
        ]);
    }

    public function store(VideoRequest $request)
    {
        $videoCreate = Video::create($request->all());
        $videoCreate->fill($request->all());
        $videoCreate->setSlug();
        
        return redirect()->route('videos.edit', [
            'id' => $videoCreate->id,
        ])->with(['color' => 'success', 'message' => 'Vídeo cadastrado com sucesso!']);
    }

    public function edit($id)
    {
        $video = Video::where('id', $id)->first();                
        return view('admin.videos.edit', ['video' => $video]);
    }

    public function update(VideoRequest $request, $id)
    {
        $video = Video::where('id', $id)->first();
        $video->fill($request->all());
        $video->save();
        $video->setSlug();
        
        return redirect()->route('videos.edit', [
            'id' => $video->id,
        ])->with(['color' => 'success', 'message' => 'Vídeo atualizado com sucesso!']);
    }

    public function video(Request $request)
    {
        $video = Video::where('id', $request->id)->first();        

        if(!empty($video)){        
            return response()->json([
                'embed' => $video->embed
            ]);
        }
    }

    public function videoSetStatus(Request $request)
    {        
        $video = Video::find($request->id);
        $video->status = $request->status;
        $video->save();
        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $videodelete = Video::where('id', $request->id)->first();
        $nome = \App\Helpers\Renato::getPrimeiroNome(Auth::user()->name);

        if(!empty($videodelete)){
            $json = "<b>$nome</b> você tem certeza que deseja excluir este Vídeo?";
            return response()->json(['error' => $json,'id' => $videodelete->id]);            
        }else{
            return response()->json(['error' => 'Erro ao excluir']);
        }       
    }

    public function deleteon(Request $request)
    {
        $videodelete = Video::where('id', $request->video_id)->first();  
        $postR = $videodelete->titulo;

        if(!empty($videodelete)){            
            $videodelete->delete();
        }

        return redirect()->route('videos.index')->with([
            'color' => 'success', 
            'message' => 'O vídeo '.$postR.' foi removido com sucesso!'
        ]);        
    }
}
