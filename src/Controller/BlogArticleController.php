<?php

namespace App\Controller;

use App\Entity\BlogArticle;
use App\Form\BlogArticleType;
use App\Repository\BlogArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog/article')]
class BlogArticleController extends AbstractController
{
    #[Route('/full', name: 'app_blog_article_full', methods: ['GET'])]
    public function full(BlogArticleRepository $blogArticleRepository): Response
    {
        return $this->render('blog_article/full.html.twig', [
            'blog_articles' => $blogArticleRepository->findAll(),
        ]);
    }

    #[Route('/list/{page}', name: 'app_blog_article_list', methods: ['GET'])]
    public function list(BlogArticleRepository $blogArticleRepository): Response
    {
        return $this->render('blog_article/list.html.twig', [
            'blog_articles' => $blogArticleRepository->findAll(),
        ]);
    }

    #[Route('/by/category/{category}', name: 'app_blog_article_by_category', methods: ['GET'])]
    public function by_category(BlogArticleRepository $blogArticleRepository): Response
    {
        return $this->render('blog_article/by_category.html.twig', [
            'blog_articles' => $blogArticleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_blog_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BlogArticleRepository $blogArticleRepository): Response
    {
        $blogArticle = new BlogArticle();
        $form = $this->createForm(BlogArticleType::class, $blogArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogArticleRepository->add($blogArticle);
            return $this->redirectToRoute('app_blog_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog_article/new.html.twig', [
            'blog_article' => $blogArticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_blog_article_show', methods: ['GET'])]
    public function show(BlogArticle $blogArticle): Response
    {
        return $this->render('blog_article/show.html.twig', [
            'blog_article' => $blogArticle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_blog_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BlogArticle $blogArticle, BlogArticleRepository $blogArticleRepository): Response
    {
        $form = $this->createForm(BlogArticleType::class, $blogArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogArticleRepository->add($blogArticle);
            return $this->redirectToRoute('app_blog_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog_article/edit.html.twig', [
            'blog_article' => $blogArticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_blog_article_delete', methods: ['POST'])]
    public function delete(Request $request, BlogArticle $blogArticle, BlogArticleRepository $blogArticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogArticle->getId(), $request->request->get('_token'))) {
            $blogArticleRepository->remove($blogArticle);
        }

        return $this->redirectToRoute('app_blog_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
