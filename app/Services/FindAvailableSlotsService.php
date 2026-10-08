<?php

namespace App\Services;

use App\DTO\Booking\FindAvailableSlotsDTO;
use App\Models\Service;
use App\Repositories\BookingRepository;

class FindAvailableSlotsService
{
    private const START_DAY = '08:00';

    private const END_DAY = '21:00';

    private const STEP = 15;

    public function __construct(public BookingRepository $repository) {}

    public function handle(FindAvailableSlotsDTO $dto): array
    {
        $service = Service::findOrFail($dto->serviceId);
        $duration = $service->duration_minutes;
        $bookings = $this->repository->getForDay(
            $dto->employeeId,
            $dto->date
        );
        $slots = [];
        $current = $dto->date->copy()->setTimeFromTimeString(self::START_DAY);
        $endDay = $dto->date->copy()->setTimeFromTimeString(self::END_DAY);
        foreach ($bookings as $booking) {
            while ($current->copy()->addMinutes($duration) <= $booking->start_at) {
                $slots[] = [
                    'start_at' => $current->format('H:i'),
                    'end_at' => $current->copy()->addMinutes($duration)->format('H:i'),
                ];
                $current->addMinutes(self::STEP);
            }
            $current = max($current, $booking->end_at);
        }
        while ($current->copy()->addMinutes($duration) <= $endDay) {
            $slots[] = [
                'start_at' => $current->format('H:i'),
                'end_at' => $current->copy()->addMinutes($duration)->format('H:i'),
            ];
            $current->copy()->addMinutes(self::STEP);
        }

        return $slots;
    }
}
