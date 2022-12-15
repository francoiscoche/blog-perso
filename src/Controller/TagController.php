<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * Return all the tag related to posts
     *
     * @param TagRepository $tag
     * @return Response
     */
    #[Route('/tags', name: 'app_tag', methods:['GET'])]
    public function index(TagRepository $tag): Response
    {
        $tags = $tag->findAll();

        return $this->render('pages/tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * Return all posts related to selected tags
     *
     * @param Tag $tag
     * @param PostRepository $repo
     * @return Response
     */
    #[Route('/tags/{slug}', name: 'app_tag_show', methods:['GET'])]
    public function show(Tag $tag, PostRepository $repo): Response
    {
        $posts = $repo->findByTag($tag);

        return $this->render('pages/tag/show.html.twig', [
            'posts' => $posts,
            'tag' => $tag
        ]);
    }
}
