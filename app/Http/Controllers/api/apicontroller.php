<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class apicontroller extends Controller
{
    public function getData()
    {
        $response = Http::get('https://randomuser.me/api/?results=5');
        $data = $response->json();

        $personas = $data["results"];

        $personasFiltradas = [];
        foreach ($personas as $persona) {
            $nombreCompleto = $persona["name"]["first"] . ' ' . $persona["name"]["last"];
            $personasFiltradas[] = [
                "nombre" => $nombreCompleto,
            ];
        }

        $letras = [];

        foreach ($personas as $persona) {
            $nombreCompleto = $persona["name"]["first"] . $persona["name"]["last"];
            $letras = array_merge($letras, str_split(preg_replace('/[^a-zA-Z]/', '', $nombreCompleto)));
        }

        $letrasFrecuencia = array_count_values($letras);

        $letraMasUtilizada = "";
        $maxFrecuencia = 0;

        foreach ($letrasFrecuencia as $letra => $frecuencia) {
            if ($frecuencia > $maxFrecuencia) {
                $letraMasUtilizada = $letra;
                $maxFrecuencia = $frecuencia;
            }
        }

        return response()->json([
            "personas" => $personasFiltradas,
            "letra_mas_utilizada" => $letraMasUtilizada,
        ]);
    }
}
