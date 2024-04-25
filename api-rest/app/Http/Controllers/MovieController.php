<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $Movies = Movie::all();
        return response()->json($Movies);
    }


    public function store(Request $request)
    {
        // Validar la solicitud
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:128',
            'description' => 'required|string|min:1|max:1024',
            'directors' => 'required|string|min:1|max:128',
            'actors' => 'required|string|min:1|max:128',
            'video_file' => 'required|file|mimes:mp4|max:102400', // 100 MB máximo, ajusta según sea necesario
            'img_file' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2 MB máximo, ajusta según sea necesario
            'duration' => 'required|numeric',
            'category' => 'required|string|min:1|max:8',
            'gender' => 'required|string|min:1|max:64',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        // Almacenar el archivo de video
        $videoPath = $request->file('video_file')->store('videos', 'public');

        // Almacenar el archivo de imagen
        $imgPath = $request->file('img_file')->store('images', 'public');

        // Crear una nueva instancia de la película con las rutas de los archivos
        $movie = new Movie([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'directors' => $request->input('directors'),
            'actors' => $request->input('actors'),
            'video_path' => $videoPath,
            'img_path' => $imgPath,
            'duration' => $request->input('duration'),
            'category' => $request->input('category'),
            'gender' => $request->input('gender'),
        ]);

        // Guardar la película en la base de datos
        $movie->save();

        // Generar URLs para acceder a la imagen y al video
        $imageUrl = asset('storage/' . $movie->img_path);
        $videoUrl = asset('storage/' . $movie->video_path);

        $movie->img_path = 'storage/' . $movie->img_path;
        $movie->video_path = 'storage/' . $movie->video_path;

        // Guardar la película en la base de datos
        $movie->save();


        return response()->json([
            'status' => true,
            'message' => 'Movie created successfully',
            'image_url' => $imageUrl,
            'video_url' => $videoUrl,
        ], 200);
    }



    public function upImage(Request $request){
    $nombreArchivo = pathinfo($request->path, PATHINFO_BASENAME); // Obtener el nombre del archivo

    // Mover el archivo al almacenamiento de Laravel
    Storage::putFileAs('public/imagenes', $request->path, $nombreArchivo);

        return response()->json([
            'status' => true,
            'message' => $request->input()
        ], 200);
    }


    public function show(Movie $Movie)
    {
        return response()->json([
            'status' => true,
            'data' => $Movie
        ], 200);
    }


    public function update(Request $request, Movie $Movie)
    {
        $rules = [
            'name' => 'required|string|min:1|max:128',
            'description' => 'required|string|min:1|max:256',
            'directors' => 'required|string|min:1|max:128',
            'actors' => 'required|string|min:1|max:128',
            'video_path' => 'required|string|min:1|max:128',
            'img_path' => 'required|string|min:1|max:128',
            'duration' => 'required|numeric',
        ];
        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $Movie->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Movie updated successfully'
        ], 200);
    }


    public function destroy(Movie $Movie)
    {
        $Movie->delete();
        return response()->json([
            'status' => true,
            'message' => 'Movie deleted successfully'
        ], 200);
    }

}
