<?php

namespace App\Util;

use App\Util\CommonMark\Extension\InlinesOnly\SpecialExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Output\RenderedContentInterface;

class MarkdownConvert
{
    private readonly MarkdownConverter $converter;

    public function __construct()
    {
        $environment = new Environment();
        $environment->addExtension(new SpecialExtension());

        $this->converter = new MarkdownConverter($environment);
    }

    public function convert(string $markdown): RenderedContentInterface
    {
        return $this->converter->convert($markdown);
    }
}