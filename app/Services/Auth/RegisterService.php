<?php

namespace App\Services\Auth;

use App\DTO\Auth\RegisterUserDto;
use App\Repositories\Users\UserRepository;

class RegisterService
{
    public function __construct(
        public readonly UserRepository $repository
    ) {}

    public function handle(RegisterUserDto $dto)
    {
        return $this->repository->create($dto);
    }
}
