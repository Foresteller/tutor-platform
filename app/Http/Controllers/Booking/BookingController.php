<?php

namespace App\Http\Controllers\Booking;

use App\DTO\Booking\CreateBookingDto;
use App\DTO\Booking\FindAvailableSlotsDTO;
use App\Http\Requests\FindAvailableSlotsRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Services\Booking\BookingService;
use App\Services\FindAvailableSlotsService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class BookingController
{
    private FindAvailableSlotsService $service;

    public function __construct(FindAvailableSlotsService $service)
    {
        $this->service = $service;
    }

    public function available(FindAvailableSlotsRequest $request): JsonResponse
    {
        $dto = new FindAvailableSlotsDTO(
            employeeId: $request->validated('employee_id'),
            serviceId: $request->validated('service_id'),
            date: Carbon::parse($request->validated('date'))
        );

        $available = $this->service->handle($dto);

        return response()->json($available);
    }

    public function store(StoreBookingRequest $request, BookingService $service): JsonResponse
    {
        $dto = new CreateBookingDto(
            userId: auth()->id(),
            serviceId: $request->validated('service_id'),
            employeeId: $request->validated('employee_id'),
            startAt: Carbon::parse($request->validated('start_at')),
            endAt: Carbon::parse($request->validated('end_at'))
        );

        $booking = $service->handle($dto);

        return response()->json($booking, 201);
    }
}
