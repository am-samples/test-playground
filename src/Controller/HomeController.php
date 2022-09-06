<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use League\CommonMark\CommonMarkConverter;

class HomeController extends AbstractController
{
    public function __construct(private readonly CommonMarkConverter $converter) {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/markdown', name: 'app_markdown_convert', methods: 'POST')]
    public function markdown(Request $request): Response
    {
        $markdown = $request->get('markdown') ?? '';
        $html = $this->converter->convert($markdown);

        return new Response($html->getContent());
    }
}
