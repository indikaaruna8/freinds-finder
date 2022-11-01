<?php

namespace In\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="app_home", defaults={"__key": 1})
     */
    public function index(): Response
    {
        $data = [
            'category' => '...',
            'promotions' => ['...', '...'],
        ];

        return $this->render('home/index.html.twig', $data);
    }

    /**
     * @Route("/about", name="app_about", defaults={"__key": 1})
     */
    public function about(): Response
    {
        $data = [
            'category' => '...',
            'promotions' => ['...', '...'],
        ];

        return $this->render('home/index.html.twig', $data);
    }

    /**
     * @Route("/services", name="app_services", defaults={"__key": 1})
     */
    public function services(): Response
    {
        $data = [
            'category' => '...',
            'promotions' => ['...', '...'],
        ];

        return $this->render('home/index.html.twig', $data);
    }

    /**
     * @Route("/services", name="app_projects", defaults={"__key": 1})
     */
    public function projects(): Response
    {
        $data = [
            'category' => '...',
            'promotions' => ['...', '...'],
        ];

        return $this->render('home/index.html.twig', $data);
    }

    /**
     * @Route("/contact", name="app_contact", defaults={"__key": 1})
     */
    public function contact(): Response
    {
        $data = [
            'category' => '...',
            'promotions' => ['...', '...'],
        ];

        return $this->render('home/index.html.twig', $data);
    }

}
