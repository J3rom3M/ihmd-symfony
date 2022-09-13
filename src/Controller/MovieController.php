<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name="app_movie", methods={"GET"})
     */
    public function getAllMovies(MovieRepository $movieRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $movies = $movieRepository->findAll();

        // PAGINANTION KNP/PAGINATOR
        $movieList = $paginator->paginate(
            $movies,
            $request->query->getInt('page', 1),
            20

        );
        
        return $this->render('movie/list.html.twig', [
            'movieList' => $movieList,
        ]);
    }

    /**
     * Get one movie
     *
     * @Route("/movie/{id}", name="movie_get_one", methods={"GET"})
     */
    public function getOneMovie(MovieRepository $movieRepository, $id): Response
    {
        $movie = $movieRepository->find($id);
        // 404 ?
        if ($movie === null) {
            // On envoie une vraie réponse en JSON
            throw $this->createNotFoundException("Movie not found.");
        }

        return $this->render('movie/detail.html.twig', [
            'movieDetail' => $movie,
        ]);
    }
}
