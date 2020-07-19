<?php

namespace App\Domain\PvHasUser\Service;

use UnexpectedValueException;
use App\Domain\Pv\Data\PvGetData;
use App\Domain\PvHasUser\Repository\PvHasUserGetterRepository;
use App\Domain\User\Data\UserGetData;
use App\Domain\User\Repository\UserGetterRepository;

/**
 * Service.
 */
final class PvHasUserGetter
{
    /**
     * @var PvHasUserGetterRepository
     */
    private $repository;

    protected $userRepository;

    /**
     * The constructor.
     *
     * @param PvHasUserGetterRepository $repository The repository
     */
    public function __construct(PvHasUserGetterRepository $repository, UserGetterRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function getPvByUserId(int $userId): array
    {
        // Validation
        if (empty($userId)) {
            throw new UnexpectedValueException('id required');
        }

        if ($userId == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        $pvs = $this->repository->getPvByUserId($userId);

        //Supprime les doublons dans le tableau
        $result = array_unique($pvs);

        return (array) $result;
    }

    public function getPvOwner(PvGetData $pv): UserGetData
    {
        $owner = $this->repository->getPvOwner($pv->id_pv);

        return $owner;
    }

    public function getPvHasUsers(PvGetData $pv): array
    {
        $pvHasUsers = $this->repository->getAllPvHasUser($pv->id_pv);

        return $pvHasUsers;
    }

    public function getPvHasUsersFromPvs(array $pvs): array
    {
        foreach ($pvs as $pv) {
            $allPHU = $this->repository->getAllPvHasUser($pv->id_pv);
            foreach ($allPHU as $pHU) {
                $users_ids[] = $pHU->user_id;
            }
        }
        foreach ($users_ids as $user) {
            $allParticipants[] = $this->userRepository->getUserWithStatusById($user);
        }

        return (array) $allParticipants;
    }
}
