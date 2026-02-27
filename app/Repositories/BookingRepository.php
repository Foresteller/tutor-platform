<?php

namespace App\Repositories;

use App\DTO\Booking\CreateBookingDto;
use App\DTO\Booking\FindAvailableSlotsDTO;
use App\Models\Booking;
use Carbon\Carbon;

class BookingRepository
{
    public function hasTimeConflict(int $employeeId, Carbon $start, Carbon $end): bool
    {
        return Booking::where('employee_id', $employeeId)
            ->where(function ($q) use ($start, $end) {
                $q->where('start_at', '<', $end)
                    ->where('end_at', '>', $start);
            });
    }
    public function create(CreateBookingDto $data): Booking
    {
        return Booking::create([
            'user_id' => $data->userId,
            'service_id' => $data->serviceId,
            'employee_id' => $data->employeeId,
            'start_at' => $data->startAt,
            'end_at' => $data->endAt
        ]);
    }
    public function getForDay(FindAvailableSlotsDTO $employeeId, Carbon $date)
    {
        return Booking::where('employee_id', $employeeId)
            ->whereDate('start_at', $date->toDateString())
            ->orderBy('start_at')
            ->get(['start_at','end_at']);
    }
}
