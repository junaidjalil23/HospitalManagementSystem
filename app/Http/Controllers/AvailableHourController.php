<?php

namespace App\Http\Controllers;

use App\Models\AvailableHour;
use Illuminate\Http\Request;

class AvailableHourController extends Controller
{
    public function updateBookingStatus(Request $request, $id)
    {
        $availableHour = AvailableHour::findOrFail($id);


        $availableHour->update([
            'is_booked' => $request->input('is_booked'),
        ]);

        return response()->json(['message' => 'Booking status updated successfully']);
    }

}
