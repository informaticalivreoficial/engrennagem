<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
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

    // public function store(VideoRequest $request)
    // {
    //     $criarGaleria = Galeria::create($request->all());
    //     $criarGaleria->fill($request->all());
    //     $criarGaleria->setSlug();

    //     $validator = Validator::make($request->only('files'), ['files.*' => 'image']);

    //     if ($validator->fails() === true) {
    //         return redirect()->back()->withInput()->with([
    //             'color' => 'orange',
    //             'message' => 'Todas as imagens devem ser do tipo jpg, jpeg ou png.',
    //         ]);
    //     }
        
    //     if ($request->allFiles()) {
    //         foreach ($request->allFiles()['files'] as $image) {
    //             $galeriaGb = new GaleriaGb();
    //             $galeriaGb->galeria = $criarGaleria->id;
    //             $galeriaGb->path = $image->storeAs(env('AWS_PASTA') . 'galerias/' . $criarGaleria->id, Str::slug($request->titulo) . '-' . str_replace('.', '', microtime(true)) . '.' . $image->extension());
    //             $galeriaGb->save();
    //             unset($galeriaGb);
    //         }
    //     }
    //     return redirect()->route('galerias.edit', [
    //         'id' => $criarGaleria->id,
    //     ])->with(['color' => 'success', 'message' => 'Galeria cadastrada com sucesso!']);
    // }

    public function video(Request $request)
    {
        $video = Video::where('id', $request->id)->first();        

        if(!empty($video)){        
            return response()->json([
                'embed' => $video->embed
            ]);
        }
    }
}
