<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{   
    #[Route('/users', name: 'users')]
    public function users(): Response
    {
        $users = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();

        if (!$users) {
            throw $this->createNotFoundException(
                'No users found'
            );
        }
        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName()
            ];
        }

        return $this->json($result);
    }
    
    #[Route('/users/{id}', name: 'user')]
    public function user(int $id): Response
    {
        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id = '.$id
            );
        }

        return $this->json([    
            'id' => $user->getId(),        
            'firstName' => $user->getFirstName(),
            'LastName' => $user->getLastName()
        ]);
    }

    #[Route('/user', name: 'user-rand')]
    public function userRand(): Response
    {
        $users = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();

        if (!$users) {
            throw $this->createNotFoundException(
                'No users found'
            );
        }
        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName()
            ];
        }

        $userRand = array_rand($result, 1);
        
        return $this->json($result[$userRand]);
    }
}
