<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/users', name: 'app_users_')]
class UsersController extends AbstractController
{
    #[Route('/', name: 'users_list', methods: ['GET'])]
    public function list(EntityManagerInterface $em): Response
    {
        $users = $em->getRepository(User::class)->findAll();
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
            'users' => $users
        ]);
    }

    #[Route('/{id}', name: 'user_info', methods: ['GET'])]
    public function info(int $id, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(User::class)->findOneBy(['id' => $id]);
        return $this->render('users/info.html.twig', [
            'controller_name' => 'UsersController',
            'user' => $user
        ]);
    }
}
