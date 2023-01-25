<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\CommentsRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
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

        $posts = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('pages/post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * Return selected post by slug and form comments user
     *
     * @param Post $post
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route('/posts/{slug}', name: 'app_post_show', methods:['GET', 'POST'])]
    public function show(Post $post, Request $request, EntityManagerInterface $em, CommentsRepository $commentsRepository): Response
    {
        $comment = new Comments();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        $comments = $commentsRepository->getComments($post);

        if( $form->isSubmitted() && $form->isValid())
        {
            $comment = $form->getData();
            $comment->setPost($post);
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Il tuo commento è stato inviato. Sarà soggetto a convalida. Grazie!');
            return $this->redirectToRoute('app_post_show', ['slug' => $post->getSlug()]);
        }

        return $this->render('pages/post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'comments' => $comments
        ]);
    }
}
