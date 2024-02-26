<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class PokemonController extends Controller
{
    public function fetchPokemons(Request $request) {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon');
        $pokemons = $response->json();
        return $pokemons;
    }

    public function savePokemon(Request $request) {
        try {
            $pokemon = Pokemon::create([
                'name' => $request->name,
                'url'  => $request->url,
                'user_id' => Auth::user()->id
            ]);
        
            return $pokemon;
        } catch (\Exception $e) {
            // Registre a exceção ou trate conforme necessário
            return response()->json(['error' => 'Erro ao salvar o Pokémon: ' . $e->getMessage()], 500);
        }
    }

    public function listImportedPokemons(Request $request) {
        $pokemons = Pokemon::where('user_id','=', Auth::user()->id)->get();
        return $pokemons;
    }
}
