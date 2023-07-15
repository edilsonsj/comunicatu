<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manifestation;

class ManifestationController extends Controller
{
    public function index () {

        $manifestations = Manifestation::all();

        return view('welcome', ['manifestations' => $manifestations]);

    }

    public function create () {

        return view('manifestations.create');

    }

    public function store (Request $request) {

        $manifestation = new Manifestation;

        $manifestation->column = $request->form_name;
        

    }
}
