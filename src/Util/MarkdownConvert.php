<?php

namespace App\Util;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\InlinesOnly\InlinesOnlyExtension;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Output\RenderedContentInterface;

class MarkdownConvert
{
    private readonly MarkdownConverter $converter;

    public function __construct()
    {
        $environment = new Environment();
        $environment->addExtension(new InlinesOnlyExtension());
        $environment->mergeConfig([]);

        $this->converter = new MarkdownConverter($environment);
    }

    public function convert(string $markdown): RenderedContentInterface
    {
        return $this->converter->convert($markdown);
    }
}