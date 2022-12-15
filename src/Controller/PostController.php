<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * Return all the post
     *
     * @param PostRepository $repo
     * @return Response
     */
    #[Route('/posts', name: 'app_post', methods:['GET'])]
    public function index(PostRepository $repo): Response
    {
        $posts = $repo->findAll();
        
        return $this->render('pages/post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * Return selected post by slug
     *
     * @param Post $post
     * @return Response
     */
    #[Route('/posts/{slug}', name: 'app_post_show', methods:['GET'])]
    public function show(Post $post): Response
    {
        return $this->render('pages/post/show.html.twig', [
            'post' => $post,
        ]);
    }
}
