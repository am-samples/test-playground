<?php

declare(strict_types=1);

namespace App\Util\CommonMark\Extension\InlinesOnly;

use League\CommonMark as Core;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark;
use League\CommonMark\Extension\CommonMark\Delimiter\Processor\EmphasisDelimiterProcessor;
use League\CommonMark\Extension\ConfigurableExtensionInterface;
use League\CommonMark\Extension\InlinesOnly\ChildRenderer;
use League\Config\ConfigurationBuilderInterface;
use Nette\Schema\Expect;

final class SpecialExtension implements ConfigurableExtensionInterface
{

    public function configureSchema(ConfigurationBuilderInterface $builder): void
    {
        $builder->addSchema('commonmark', Expect::structure([
            'use_asterisk' => Expect::bool(true),
            'use_underscore' => Expect::bool(true),
            'enable_strong' => Expect::bool(true),
            'enable_em' => Expect::bool(true),
        ]));
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $childRenderer = new ChildRenderer();

        $environment
            ->addRenderer(Core\Node\Block\Document::class,  $childRenderer, 0)
            ->addRenderer(Core\Node\Block\Paragraph::class, $childRenderer, 0)
            ->addRenderer(CommonMark\Node\Inline\Emphasis::class,   new CommonMark\Renderer\Inline\EmphasisRenderer(),   0)
            ->addRenderer(CommonMark\Node\Inline\Strong::class,     new CommonMark\Renderer\Inline\StrongRenderer(),     0)
            ->addRenderer(Core\Node\Inline\Text::class,             new Core\Renderer\Inline\TextRenderer(),             0)
            ->addRenderer(CommonMark\Node\Inline\HtmlInline::class, new CommonMark\Renderer\Inline\HtmlInlineRenderer(), 0)
            ->addRenderer(Core\Node\Inline\Newline::class,          new Core\Renderer\Inline\NewlineRenderer(),          0)
        ;

        if ($environment->getConfiguration()->get('commonmark/use_asterisk')) {
            $environment->addDelimiterProcessor(new EmphasisDelimiterProcessor('*'));
        }

        if ($environment->getConfiguration()->get('commonmark/use_underscore')) {
            $environment->addDelimiterProcessor(new EmphasisDelimiterProcessor('_'));
        }
    }
}