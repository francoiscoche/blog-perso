<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    /**
     * Return all the post
     *
     * @param PostRepository $repo
     * @return Response
     */
    #[Route('/posts', name: 'app_post', methods:['GET'])]
    public function index(PostRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        // $query = $repo->findAll();
        $query = $repo->findPosts();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        
        return $this->render('pages/post/index.html.twig', [
            'pagination' => $pagination,
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
