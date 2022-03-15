<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', ['isHomepage' => true]);
    }

    #[Route('/blog/article', name: 'app_blog_article')]
    public function article(): Response
    {
        return $this->render('blog/article.html.twig');
    }

    #[Route('/blog/news', name: 'app_blog_news')]
    public function news(): Response
    {
        return $this->render('blog/news.html.twig');
    }

    #[Route('/blog/random', name: 'app_blog_random')]
    public function random(): Response
    {
        return $this->render('blog/random.html.twig');
    }

    #[Route('/blog/list', name:'app_blog_list')]
    public function list(): Response
    {
        return $this->render('blog/list.html.twig');
    }

    #[Route('/blog/view', name: 'app_blog_view')]
    public function view(): Response
    {
        return $this->render('blog/view.html.twig');
    }
}
