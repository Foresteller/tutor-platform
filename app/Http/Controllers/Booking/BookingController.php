<?php

namespace App\Http\Controllers\Booking;

use App\DTO\Booking\CreateBookingDto;


use App\DTO\Booking\FindAvailableSlotsDTO;
use App\Models\Booking;
use App\Services\Booking\BookingService;
use App\Services\FindAvailableSlotsService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class BookingController
{
    private FindAvailableSlotsService $service;

    public function __construct(FindAvailableSlotsService $service)
    {
       $this->service = $service;
    }

    public function available(Request $request)
    {
        $dto = new FindAvailableSlotsDTO(
            employeeId: $request->employee_id,
            serviceId: $request->service_id,
            date: $request->date
        );
        $available = $this->service->handle($dto);
        return response()->json($available);
    }
    public function store(Request $request, BookingService $service): JsonResponse
    {
        $dto = new CreateBookingDto(
            userId: auth()->id(),
            serviceId: $request->service_id,
            employeeId: $request->employee_id,
            startAt: Carbon::parse($request->start_at),
            endAt: Carbon::parse($request->end_at)
        );
        $booking = $service->handle($dto);
        return response()->json($booking);
    }
}
