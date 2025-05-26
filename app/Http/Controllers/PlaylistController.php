<?php

namespace App\Http\Controllers;

use App\Models\playlist;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PlaylistController extends Controller
{
    /**
     * funcionando
     */
    public function index()
    {
        $regplaylist = playlist::All();
        $contador = $regplaylist->count();
        return Response()->json($regplaylist);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nm_musica' => 'required',
            'artista' => 'required',
            'gravadora' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registros = playlist::create($request->all());

        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'playlist cadastrado com sucesso',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'erro ao cadastrar o playlist'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $regplaylist = playlist::find($id);

        if ($regplaylist) {
            return response()->json([
                'success' => true,
                'message' => 'playlist encontrado',
                'data' => $regplaylist
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'playlist não encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nm_musica' => 'required',
            'artista' => 'required',
            'gravadora' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $regplaylistBanco = playlist::find($id);

        if (!$regplaylistBanco) {
            return respone()->json([
                'success' => false,
                'message' => 'playlist não encontrado',
            ], 404);
        }

        $regplaylistBanco->nm_musica = $request->nm_musica;
        $regplaylistBanco->artista = $request->artista;
        $regplaylistBanco->gravadora = $request->gravadora;

        if ($regplaylistBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'playlist atualizado com sucesso',
                'data' => $regplaylistBanco
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'erro ao atualizar o playlist'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regplaylist = playlist::find($id);
        if (!$regplaylist) {
            return response()->json([
                'success' => false,
                'message' => 'playlist não encontrado'
            ], 404);
        }
            if ($regplaylist->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'playlist deletado com sucesso'
                ], 200);
            }
        }
}
    