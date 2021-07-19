<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    private $userRepo;

    /**
     * Class constructor.
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {
        $users = $this->userRepo->findAll();
        return $this->render('default/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/{user}", name="default_details", requirements={"user":"\d+"})
     */
    public function details(User $user): Response
    {
        return $this->render('default/details.html.twig', [
            'user' => $user,
        ]);
    }
}
