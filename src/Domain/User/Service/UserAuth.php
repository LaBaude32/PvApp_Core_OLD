<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserGetData;
use App\Domain\User\Repository\UserGetterRepository;

final class UserAuth
{
  /**
   * @var UserGetterRepository
   */
  private $repository;

  /**
   * The constructor.
   *
   * @param UserGetterRepository $repository The repository
   */
  public function __construct(UserGetterRepository $repository)
  {
    $this->repository = $repository;
  }

  public function checkLogin(array $datas): bool
  {
    $user = $this->repository->getUserByEmail($datas['email']);

    $result = ($datas['email'] === $user->email && $datas['password'] === $user->pwd);

    return (bool) $result;
  }
}
