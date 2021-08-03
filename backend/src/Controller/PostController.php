<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $posts = $this->getDoctrine()
        ->getRepository(Post::class)
        ->findAll();

        $result = [];

        if ($posts) {
            foreach ($posts as $post) {
                array_push($result, $post->transformPostToArray($post));
            }
        }
    
        return $this->json($result);
    }    
}
