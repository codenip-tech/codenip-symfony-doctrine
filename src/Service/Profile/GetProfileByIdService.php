<?php

namespace App\Service\Profile;

use App\Entity\Profile;
use App\Repository\DoctrineProfileRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetProfileByIdService
{
    public function __construct(private DoctrineProfileRepository $doctrineProfileRepository)
    {
    }

    public function __invoke(string $id): Profile
    {
        if (null === $profile = $this->doctrineProfileRepository->findOneById($id)) {
            throw new NotFoundHttpException(sprintf('Profile with id %s not found', $id));
        }

        return $profile;
    }
}
