<?php

namespace App\Controller;

use App\Entity\BlogCategory;
use App\Form\BlogCategoryType;
use App\Repository\BlogCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog/category')]
class BlogCategoryController extends AbstractController
{
    #[Route('/', name: 'app_blog_category_index', methods: ['GET'])]
    public function index(BlogCategoryRepository $blogCategoryRepository): Response
    {
        return $this->render('blog_category/index.html.twig', [
            'blog_categories' => $blogCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_blog_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BlogCategoryRepository $blogCategoryRepository): Response
    {
        $blogCategory = new BlogCategory();
        $form = $this->createForm(BlogCategoryType::class, $blogCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogCategoryRepository->add($blogCategory);
            return $this->redirectToRoute('app_blog_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog_category/new.html.twig', [
            'blog_category' => $blogCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_blog_category_show', methods: ['GET'])]
    public function show(BlogCategory $blogCategory): Response
    {
        return $this->render('blog_category/show.html.twig', [
            'blog_category' => $blogCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_blog_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BlogCategory $blogCategory, BlogCategoryRepository $blogCategoryRepository): Response
    {
        $form = $this->createForm(BlogCategoryType::class, $blogCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogCategoryRepository->add($blogCategory);
            return $this->redirectToRoute('app_blog_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('blog_category/edit.html.twig', [
            'blog_category' => $blogCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_blog_category_delete', methods: ['POST'])]
    public function delete(Request $request, BlogCategory $blogCategory, BlogCategoryRepository $blogCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogCategory->getId(), $request->request->get('_token'))) {
            $blogCategoryRepository->remove($blogCategory);
        }

        return $this->redirectToRoute('app_blog_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
