<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comments/add', methods: ['POST'], name: 'create-comment')]
    public function createComment(Request $request): Response
    {
        $body = json_decode($request->getContent(), true);
        $manager = $this->getDoctrine()->getManager();

        $post = $manager->getRepository(Post::class)->find($body['postId']);
        $user= $manager->getRepository(User::class)->find($body['userId']);

        if (!$post) {
            throw $this->createNotFoundException(
                'No post found'
            );
        }

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found'
            );
        }

        $comment = new Comment($body['text'], $body['createdAt'], $post, $user);
        
        $manager->persist($comment);
        $post = $comment->getPost();
        $post->addComment($comment);
        $manager->flush();

        return new Response('Comment from id = $id has been created', Response::HTTP_CREATED);
    }



    #[Route('/comments/update/{id}', methods: ['PATCH'], name: 'update-comment')]
    public function updateComment(Request $request, $id): Response
    {
        $body = json_decode($request->getContent(), true);

        $manager = $this->getDoctrine()->getManager();
        $comment = $manager->getRepository(Comment::class)->find($id);
        
        if (!$comment) {
            throw $this->createNotFoundException(
                'No comment found'
            );
        }
        
        if (isset($body['text'])) {
            $comment->setText($body['text']);
        }

        if (isset($body['createdAt'])) {
            $comment->setCreatedAt($body['createdAt']);
        }

        $post = $comment->getPost();
        $post->addComment($comment);

        $manager->flush();

        return new Response("Comment from id = $id has been updated", Response::HTTP_OK);
    }



    #[Route('/comments/remove/{id}', methods: ['DELETE'], name: 'delete-comment')]
    public function deleteComment($id): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $comment = $manager->getRepository(Comment::class)->find($id);
        
        if (!$comment) {
            throw $this->createNotFoundException(
                'No comment found'
            );
        }

        $post = $comment->getPost();
        $manager->remove($comment);
        $post->removeComment($comment);

        $manager->flush();
          
        return new Response('Comment from id = $id has been deleted', Response::HTTP_OK);
    }
}
