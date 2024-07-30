<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class VesselController extends Controller
{
    public function index()
    {
        $vessels = DB::table('vessels')->get();
        $vesselData = [];

        foreach ($vessels as $vessel) {
            $vesselData[$vessel->vessel_name][$vessel->voyage][] = [
                'id' => $vessel->id,
                'kode_booking' => $vessel->kode_booking,
            ];
        }

        return view('vessel', compact('vesselData'));
    }

    public function addVessel(Request $request)
    {
        $request->validate([
            'vesselName' => 'required|string|max:255',
            'voyageName' => 'required|string|max:255',
        ]);

        $vesselName = $request->input('vesselName');
        $voyageName = $request->input('voyageName');

        $exists = DB::table('vessels')
            ->where('vessel_name', $vesselName)
            ->where('voyage', $voyageName)
            ->exists();

        if ($exists) {
            return redirect()->route('vessel.index')->with('error', 'Voyage already exists for this vessel.');
        }

        DB::table('vessels')->insert([
            'vessel_name' => $vesselName,
            'voyage' => $voyageName,
            'kode_booking' => '',
        ]);

        return redirect()->route('vessel.index')->with('message', 'Vessel added successfully.');
    }

    public function addBooking(Request $request)
    {
        $request->validate([
            'vesselId' => 'required|integer',
            'kodeBooking' => 'required|string|max:255',
        ]);

        $vesselId = $request->input('vesselId');
        $kodeBooking = $request->input('kodeBooking');

        DB::table('vessels')
            ->where('id', $vesselId)
            ->update([
                'kode_booking' => DB::raw("CONCAT(IF(kode_booking='', '', CONCAT(kode_booking, ', ')), '$kodeBooking')")
            ]);

        return redirect()->route('vessel.index')->with('message', 'Booking updated successfully.');
    }

    public function deleteBooking(Request $request)
    {
        $request->validate([
            'bookingId' => 'required|integer',
        ]);

        $bookingId = $request->input('bookingId');

        DB::table('vessels')->where('id', $bookingId)->delete();

        return redirect()->route('vessel.index')->with('message', 'Booking deleted successfully.');
    }
}
