<?php

namespace App\Controller;

use App\Entity\Pet;
use App\Factory\PetFactory;
use App\Repository\BreedRepository;
use App\Repository\PetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetController extends AbstractController
{
    #[Route('/api/pets', name: 'create_pet', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        PetFactory $petFactory,
        BreedRepository $breedRepository,
        PetRepository $petRepository
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $selectedBreed = $breedRepository->find($data['selectedBreed']);
        $petResult = $petFactory->createPet(
            $data['name'],
            $data['gender'],
            $selectedBreed,
            $data['dateOfBirth'],
            $data['approximateAge'],
            $data['otherBreed'],
            $data['otherBreedDetails']
        );

        if ($petResult->isSuccess()) {
            $petRepository->save($petResult->getData());
            return new JsonResponse(['status' => 'Pet created'], 201);
        } else {
            return new JsonResponse(['error' => $petResult->getError()], 400);
        }
    }

    #[Route('/', name: 'app_pet_form')]
    public function petForm(): Response
    {
        return $this->render('base.html.twig');
    }

}
