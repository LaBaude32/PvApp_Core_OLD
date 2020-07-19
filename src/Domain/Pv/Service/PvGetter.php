<?php

namespace App\Domain\Pv\Service;

use App\Domain\Pv\Data\PvGetData;
use UnexpectedValueException;
use App\Domain\Pv\Repository\PvGetterRepository;

/**
 * Service.
 */
final class PvGetter
{
    /**
     * @var PvGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvGetterRepository $repository The repository
     */
    public function __construct(PvGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the pvs.
     *
     * @return array All the pvs
     */
    public function getPvByAffairId(int $id): array
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        // Get All pvs
        $pvs = $this->repository->getPvByAffairId($id);

        foreach ($pvs as $pv) {
            $pvsToReturn[] = $this->repository->getPvNumber($pv);
        }

        return (array) $pvsToReturn;
    }


    /**
     * Get one pvs.
     *
     * @return array All one pv with his items
     */
    public function getPvById(int $id): PvGetData
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        // Get one pv
        $pv = $this->repository->getPvById($id);

        return $pv;
    }

    public function getAffairsIdByPvsId(array $pvsId): array
    {
        foreach ($pvsId as $pvId) {
            $pv = $this->repository->getPvById($pvId);
            $affairsId[] = $pv->affair_id;
        }

        $result = array_unique($affairsId);

        return (array) $result;
    }

    public function getLastsPvByUserId(array $data): array
    {
        // Validation
        if (empty($data['userId'])) {
            throw new UnexpectedValueException('id required');
        }

        if ($data['userId'] == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        if ($data['numberOfPvs'] == 0) {
            $data['numberOfPvs'] = 1;
        }

        $pvs = $this->repository->getPvsByUserId($data);

        return (array) $pvs;
    }

    public function getAllPvByUserId(int $userId): array
    {
        // Validation
        if (empty($data['userId'])) {
            throw new UnexpectedValueException('id required');
        }

        $data['userId'] = $userId;
        $pvs = $this->repository->getPvsByUserId($data);

        return (array) $pvs;
    }

    public function getLotsForPv(PvGetData $pv)
    {
        $pvToReturn = $this->repository->getLotsForpv($pv);

        return $pvToReturn;
    }

    public function getPvNumber(PvGetData $pv): PvGetData
    {
        $pvToReturn = $this->repository->getPvNumber($pv);

        return $pvToReturn;
    }

    // public function getPreviousPv(PvGetData $pv): PvGetData
    // {
    //     $pvToReturn = $this->repository->getPreviousPv($pv);

    //     return $pvToReturn;
    // }
}
