<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\ReservationRequest;
use App\Http\Resources\Reservation\ReservationResource;
use App\Models\Reservation;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Reservation::class);
        $reservation = Reservation::orderBy('date', 'Desc')->get();
        return $this->succWithData(ReservationResource::collection($reservation), 'All reservations');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        $reservation = new Reservation();

        try {
            $reservation->user_id = Auth::user()->id;
            $reservation->special_id = $request->special_id;
            $reservation->time = date('H:i', strtotime($request->time));
            $reservation->date = $request->date;

            $reservation->save();
            return $this->succWithData(new ReservationResource($reservation), 'Reservation has beed saved');
        } catch (\Exception $e) {
            return $this->errMsg('Something wrong with your data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todayReservations()
    {
        $this->authorize('viewAny', Reservation::class);
        $today = Carbon::today()->toDateString();
        $todayReservations = Reservation::where('date', $today)->get();
        return $this->succWithData(ReservationResource::collection($todayReservations), 'All today reservations');
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function waitedForUser()
    {
        $today = Carbon::yesterday()->toDateString();
        $todayReservations = Reservation::where('date',">", $today)
            ->where('user_id', Auth::user()->id)
            ->get();
        return $this->succWithData(ReservationResource::collection($todayReservations), 'All waited reservations');
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allForUser()
    {

        $todayReservations = Reservation::where('user_id', Auth::user()->id)->get();
        return $this->succWithData(ReservationResource::collection($todayReservations), 'All your reservations');
    }
}
