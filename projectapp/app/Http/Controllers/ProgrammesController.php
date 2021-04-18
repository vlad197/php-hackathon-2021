<?php

namespace App\Http\Controllers;


use App\Models\Programmes;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Room;

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
            'name' => 'required|in:pilates,kangoojumps',
            'startingdate' => 'required',
            'endingdate' => 'required|date|after_or_equal:startingdate',
            'participants' => 'required',
            'room' => 'required'
        ]);

        $programmes = Programmes::create($request->all());

         return response()->json($programmes, 201);

    }

    public function update(Request $request, $id)
    {
        request()->validate([

            'name' => 'required',
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


    public function check(Request $request)
    {
        $this->validate($request, [
            'startingdate' => 'required',
            'endingdate' => 'required',
            'programmes_id' => 'required',
            'user_id' => 'required'
        ]);

        $startingdate = $request->get('startingdate');
        $endingdate = $request->get('endingdate');
        $programmes_id = $request->get('programmes_id');
        $user_id = $request->get('user_id');



        $rooms = Room::whereNotIn('id', function ($query) use ($startingdate, $endingdate, $programmes_id, $user_id) {
            $query->from('programmes')
                ->select('room_id')
                ->where('endingdate', '<=', $endingdate)
                ->where('startingdate', '>=', $startingdate)
                ->where('programmes_id', $programmes_id)
                ->where('$user_id', $user_id);
        })->where('programmes_id', $programmes_id)->get();

        if (count($rooms) === 0) {
            $request->session()->flash(
                'flash.message.first',
                ['type' => 'success', 'message' => 'Scuze, nu exista camera cu programari!']
            );
        } else {
            if (Auth::check()) {
                $programmes = new Programmes();
                $programmes->startingdate = $startingdate;
                $programmes->endingdate = $endingdate;
                $programmes->room_id = $rooms[0]->id;
                $programmes->user_id = Auth::User()->id;
                $programmes->save();

                $request->session()->flash(
                    'flash.message.first',
                    ['type' => 'success', 'message' => 'Felicitari! Programarea este activata!']
                );
            } else {
                $request->session()->flash(
                    'flash.message.first',
                    ['type' => 'success', 'message' => 'Nu esti logat!']
                );
            }
        }

        if(empty($programmes_id) || empty($user_id))
        {
            return response()->json('Nu exista user sau programare');
        }

        if(!empty($programmes_id) || !empty($user_id))
        {
            return response()->json('Exista user sau programare');
        }






        return redirect()->back();
    }

  //  public function book($id)
  //  {
  //      $programmes = Programmes::with(['user'])->whereHas('room', function ($query) use ($id) {
   //         $query->where('room_id', $id);
   //     })->get();

  //  }








}
