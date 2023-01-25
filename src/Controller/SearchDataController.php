<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchDataController extends AbstractController
{
    #[Route('/search/data', name: 'app_search_data')]
    public function index(Request $request, PostRepository $postRepository, PaginatorInterface $paginator): Response
    {
        // D'habitude on vient instancier une entity, ici on vient instancier la class qui définit les data
        $searchData = new SearchData();

        $form = $this->createForm(SearchType::class, $searchData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $posts = $postRepository->findBySearch($searchData);

            $posts = $paginator->paginate(
                    $posts, /* query NOT result */
                    $request->query->getInt('page', 1), /*page number*/
                    10 /*limit per page*/
            );

            return $this->render('pages/search_data/index.html.twig', [
                'form' => $form->createView(),
                'posts' => $posts
            ]);
        }

        return $this->render('pages/search_data/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
