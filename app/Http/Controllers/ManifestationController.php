<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manifestation;
use Illuminate\Support\Facades\DB;

class ManifestationController extends Controller
{
    public function index()
    {

        $manifestations = Manifestation::all();

        return view('welcome', ['manifestations' => $manifestations]);
    }

    public function create()
    {

        $assignments = DB::table('departments_assignments')->pluck('assignment');

        return view('manifestations.create', ['assignments' => $assignments]);
    }

    public function store(Request $request)
    {

        $manifestation = new Manifestation;

        $manifestation->description = $request->description;
        $manifestation->type = $request->type;
        $manifestation->status = 'Open';
        $manifestation->department_id = 1;

        $manifestation->lat = $request->lat;
        $manifestation->lon = $request->lng;

        //Image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $request_image = $request->image;
            $extension = $request_image->extension();
            $image_name = md5($request_image->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $request_image->move(public_path('img/manifestations'), $image_name);
            $manifestation->image = $image_name;
        }

        $user = auth()->user();
        $manifestation->user_id = $user->id;

        $manifestation->save();

        return redirect('/')->with('msg', 'Manifestacao criada com sucesso!');
    }

    public function showMap()
    {
        $manifestations = Manifestation::select('lat', 'lon')->get();
        return view('leaflet', ['manifestations' => $manifestations]);
    }

    public function getMarkers()
    {
        $coordinates = Manifestation::all();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($coordinates as $coordinate) {
            $geojson['features'][] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$coordinate->lon, $coordinate->lat],
                ],
                'properties' => [
                    'name' => $coordinate->type,
                    'description' => $coordinate->description,
                ],
            ];
        }

        return view('leaflet')->with('geojson', json_encode($geojson));
    }

    public function show()
    {
        $user_id = auth()->user()->id;
        $user_manifestations = Manifestation::where('user_id', $user_id)
            ->select('*')->get();
        return view('manifestations.show', ['user_manifestations' => $user_manifestations]);
    }

    public function edit($id)
    {
        $assignments = DB::table('departments_assignments')->pluck('assignment');


        $manifestation = Manifestation::findOrFail($id);
        return view('manifestations.edit', compact('manifestation'), ['assignments' => $assignments]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $request_image = $request->image;
            $extension = $request_image->extension();
            $image_name = md5($request_image->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $request_image->move(public_path('img/manifestations'), $image_name);

            $data['image'] = $image_name;
        }

        Manifestation::findOrFail($request->id)->update($data);

        return redirect('manifestations/show')->with('msg', 'Manifestação alterada com sucesso!');
    }

    public function destroy($id)
    {
        Manifestation::findOrFail($id)->delete();
        return redirect('manifestations/show')->with('msg', 'Manifestação deletada com sucesso');
    }
}
