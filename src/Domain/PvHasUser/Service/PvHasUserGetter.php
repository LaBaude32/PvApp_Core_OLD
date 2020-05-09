<?php

namespace App\Domain\PvHasUser\Service;

use UnexpectedValueException;
use App\Domain\Pv\Data\PvGetData;
use App\Domain\PvHasUser\Repository\PvHasUserGetterRepository;
use App\Domain\User\Data\UserGetData;

/**
 * Service.
 */
final class PvHasUserGetter
{
    /**
     * @var PvHasUserGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvHasUserGetterRepository $repository The repository
     */
    public function __construct(PvHasUserGetterRepository $repository)
    {
        $this->repository = $repository;
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
}
