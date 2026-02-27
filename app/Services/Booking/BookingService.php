<?php

namespace App\Services\Booking;

use App\DTO\Booking\CreateBookingDto;
use App\Models\Booking;
use App\Repositories\BookingRepository;

class BookingService
{

    private BookingRepository $repository;

    public function __construct(BookingRepository $repository)
    {
        $this->repository = $repository;
    }
    public function handle(CreateBookingDto $dto): Booking
    {
        if ($this->repository->hasTimeConflict(
            $dto->employeeId,
            $dto->startAt,
            $dto->endAt
        )) {
            throw new \DomainException('TIME_SLOT_BUSY');
        }
        return $this->repository->create($dto);
    }
}
