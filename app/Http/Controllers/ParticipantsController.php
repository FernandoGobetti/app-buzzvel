<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipants;
use App\Models\HolidayPlan;
use App\Models\Participants;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    protected $repository, $holiday;

    public function __construct(Participants $participants, HolidayPlan $holidayPlan)
    {
        $this->repository = $participants;
        $this->holiday = $holidayPlan;
    }

    public function store($idHoliday, StoreParticipants $request)
    {
        if (!$holiday = $this->holiday->find($idHoliday)) {
            return response()->json(['message' => 'Holiday Plan Not Found'], 404);
        }

        $holiday->participants()->create($request->all());

        return $holiday->with('participants')->get();
    }
}
