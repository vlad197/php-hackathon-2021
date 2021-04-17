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



    public function check(Request $request)
    {
        $this->validate($request, [
            'check_out_date' => 'required',
            'check_in_date' => 'required',
        ]);

        $check_in_date = $request->get('check_in_date');
        $check_out_date = $request->get('check_out_date');
        $hotel_id = $request->get('hotel_id');

        $rooms = Room::whereNotIn('id', function ($query) use ($check_in_date, $check_out_date, $hotel_id) {
            $query->from('reservations')
                ->select('room_id')
                ->where('check_out_date', '<=', $check_out_date)
                ->where('check_in_date', '>=', $check_in_date)
                ->where('hotel_id', $hotel_id);
        })->where('hotel_id', $hotel_id)->get();

        if (count($rooms) === 0) {
            $request->session()->flash(
                'flash.message.first',
                ['type' => 'success', 'message' => 'Scuze, nu exista camere libere!']
            );
        } else {
            if (Auth::check()) {
                $reservation = new Reservation();
                $reservation->check_in_date = $check_in_date;
                $reservation->check_out_date = $check_out_date;
                $reservation->room_id = $rooms[0]->id;
                $reservation->user_id = Auth::User()->id;
                $reservation->save();

                $request->session()->flash(
                    'flash.message.first',
                    ['type' => 'success', 'message' => 'Felicitari! Rezervarea este activata!']
                );
            } else {
                $request->session()->flash(
                    'flash.message.first',
                    ['type' => 'success', 'message' => 'Nu esti logat!']
                );
            }
        }

        return redirect()->back();
    }



}
