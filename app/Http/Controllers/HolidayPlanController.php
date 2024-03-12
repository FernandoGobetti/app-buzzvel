<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateHolidayPlan;
use App\Models\HolidayPlan;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HolidayPlanController extends Controller
{
    private $repository;

    public function __construct(HolidayPlan $plan)
    {
        $this->repository = $plan;
    }

    /**
     * Route::get /api/holiday
     * Lists all Holiday Plans with pagination.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index()
    {
        return $this->repository->with('participants')->paginate();
    }

    /**
     * Route::get /api/holiday/{id}
     * Creates a new record in the database, uses class to validate the fields.
     *
     * @param StoreUpdateHolidayPlan $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function store(StoreUpdateHolidayPlan $request)
    {
        $holiday = $this->repository->create($request->all());
        if (!$holiday) {
            return response()->json(['message' => 'Internal error, call the responsible programmer.'], 500);
        }
        return $holiday;
    }

    /**
     * Route::get /api/holiday/{id}
     * Returns value if found in the database.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show($id)
    {
        $holiday = $this->repository->with('participants')->find($id);
        if (!$holiday) {
            return response()->json(['message' => 'Holiday Plan Not Found'], 404);
        }
        return $holiday;
    }

    /**
     * Route::put /api/holiday/{id}
     * Changes the data passed through the request body. Uses class to validate the fields.
     *
     * @param StoreUpdateHolidayPlan $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(StoreUpdateHolidayPlan $request, $id)
    {
        $holiday = $this->repository->find($id);
        if (!$holiday) {
            return response()->json(['message' => 'Holiday Plan Not Found'], 404);
        }
        $holiday->update($request->all());
        return $holiday;
    }

    /**
     * Route::delete /api/holiday/{id}
     * Deletes the holiday plan, using the ID provided in the url.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy($id)
    {
        $holiday = $this->repository->find($id);
        if (!$holiday) {
            return response()->json(['message' => 'Holiday Plan Not Found'], 404);
        }
        $holiday->delete();
        return response()->json(['message' => 'Holiday Plan Deleted'], 204);
    }

    /**
     * Route::post /holiday/{id}/participants
     * Create the PDF File and return the path.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function generatePdf($id)
    {
        $holiday = $this->repository->with('participants')->find($id);

        if (!$holiday) {
            return response()->json(['message' => 'Holiday Plan Not Found'], 404);
        }
        $now = new DateTime();
        $formated = $now->format('Y-m-d_H-i') . ".pdf";
        Pdf::loadView('holiday/pdf', ["holiday" => $holiday])->save($formated);

        return response()->json(['message' => 'Your PDF is in ' . url('/') . '/' . $formated], 201);
    }
}
