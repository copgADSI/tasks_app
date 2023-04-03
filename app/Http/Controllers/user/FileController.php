<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Shared;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Svg\Tag\Shape;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('files','shared')->get();
        dd($users[0]);
        $user_id = auth()->user()->id;
        /* Se buscan los archivos cargados por un usuario */
        $files = File::where('user_id', $user_id)->get();
        return view('user.files.index', [
            'files' => $files,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadFiles(Request $request)
    {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $path = $file->store('public/uploads');
                $file = new File();
                $file->file_name = basename($path);
                $file->path = $path;
                $file->user_id = auth()->user()->id;
                $file->save();
            }
            return response()->json([
                'message' => 'Archivos cargados correctamente!'
            ], 200);
        }
        return response()->json([
            'message' => 'Debes enviar archivos para ser cargados correctamente!'
        ], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        if ($file->user_id === auth()->user()->id) {
            Storage::delete($file->path);
            $file->delete();
            return redirect()->route('files.index')->with('success', 'Archivo eliminado exitosamente');
        }
    }

    public function shareFile(Request $request)
    {
        $request->validate([
            'users_ids' => 'array',
            'file_id' => 'numeric'
        ]);
        $shared = new Shared();
        $user_ids = explode(',', $request->input('users_list'));
        $data = [];
        foreach ($user_ids as $user_id) {
            $data[] = [
                'user_id' => $user_id,
                'file_id' => $request->input('file_id'),
            ];
        }
        $shared->insert($data);
        return response()->json([
            'message' => 'Archivo compartido con éxito'
        ], 200);
    }
}
