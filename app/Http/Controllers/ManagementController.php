<?php

namespace App\Http\Controllers;

use App\Models\Manifestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    public function index($type = null)
    {
        $query = Manifestation::query();

        if ($type) {
            $query->where('type', $type);
        }
        $manifestations = $query->get();
        
        $manifestations_types = DB::table('manifestations')
            ->pluck('type')
            ->unique();

        return view('management.show', 
            ['manifestations' => $manifestations], 
            ['manifestations_types' => $manifestations_types],
        );
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
}
