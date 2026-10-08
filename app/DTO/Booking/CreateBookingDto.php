<?php

namespace App\DTO\Booking;

use Carbon\Carbon;

class CreateBookingDto
{
    public readonly int $userId;

    public readonly int $serviceId;

    public readonly string $employeeId;

    public readonly Carbon $startAt;

    public readonly Carbon $endAt;

    public function __construct($userId, $serviceId, $employeeId, $startAt, $endAt)
    {
        $this->userId = $userId;
        $this->serviceId = $serviceId;
        $this->employeeId = $employeeId;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }
}
