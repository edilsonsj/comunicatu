<?php

namespace App\Http\Controllers;

use App\Models\Manifestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Manifestation::query();

        // Verificar e aplicar filtro por tipo, se fornecido
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        // Verificar e aplicar filtro por status, se fornecido
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Verificar e aplicar filtro por data de início, se fornecido
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        }

        // Verificar e aplicar filtro por data de término, se fornecido
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        // Executar a consulta para obter as manifestações
        $manifestations = $query->get(); 

        // Obter os tipos únicos de manifestações para a seleção de filtro na view
        $manifestation_types = Manifestation::pluck('type')->unique();

        // Retornar a view com as manifestações e tipos de manifestações
        return view('management.show', compact('manifestations', 'manifestation_types'));
    }

    public function getManifestationsByType($type)
    {
        $manifestations = Manifestation::all();

        $manifestations_types = DB::table('manifestations')
            ->where('type', '=', $type)
            ->pluck('type')
            ->unique();

        return redirect('/management/show', ['$manifestations_types' => $manifestations_types]);
    }

    public function editAdmin($id)
    {
        $assignments = DB::table('departments_assignments')->pluck('assignment');

        $manifestation = Manifestation::findOrFail($id);
        return view('management.edit', compact('manifestation'), ['assignments' => $assignments]);
    }


    public function update(Request $request)
    {
        $data = $request->all();

        Manifestation::findOrFail($request->id)->update($data);

        return redirect('manifestations/show')->with('msg', 'Manifestação alterada com sucesso!');
    }
}
