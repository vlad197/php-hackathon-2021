<?php

namespace App\Http\Controllers;


use App\Models\Programmes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgrammesController extends Controller
{

    public function getIndex() {

        $programmes = Programmes::all();
    }

    public function show(Programmes $id)
    {
        return Programmes::find($id);
    }

    public function store(Request $request)
    {
        request()->validate([
            'startingdate' => 'required',
            'endingdate' => 'required',
            'participants' => 'required',
            'room' => 'required'
        ]);

        $programmes = Programmes::create($request->all());

         return response()->json($programmes, 201);

    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'startingdate' => 'required',
            'endingdate' => 'required',
            'participants' => 'required',
            'room' => 'required'
        ]);


        $programmes = Programmes::findOrFail($id);
        $programmes->update($request->all);

        return $programmes;
    }


    public function destroy( $id)
    {

        $programmes = Programmes::findOrFail($id);
        $programmes->delete();
        return 204;

    }







}
