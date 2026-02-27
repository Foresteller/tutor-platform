<?php

namespace App\DTO\Booking;

use Carbon\Carbon;

class FindAvailableSlotsDTO
{
    public function __construct(
        public readonly int $employeeId,
        public readonly int $serviceId,
        public readonly Carbon $date
    )
    {}
}
