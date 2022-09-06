<?php

namespace App\Controller;

use App\Util\MarkdownConvert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly CommonMarkConverter $fullConverter,
        private readonly MarkdownConvert $inlineConverter
    ) {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/markdown', name: 'app_markdown_convert', methods: 'POST')]
    public function markdown(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $markdown = $data['markdown'] ?? '';
        $html = $this->inlineConverter->convert($markdown);

        return new Response($html->getContent());
    }
}
