<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladeForkAwesome\BladeForkAwesomeServiceProvider;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('forkawesome-adjust')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg viewBox="0 0 1536 1536" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M768 1440V352c-300 0-544 244-544 544s244 544 544 544zm768-544c0 424-344 768-768 768S0 1320 0 896s344-768 768-768 768 344 768 768z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('forkawesome-adjust', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" viewBox="0 0 1536 1536" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M768 1440V352c-300 0-544 244-544 544s244 544 544 544zm768-544c0 424-344 768-768 768S0 1320 0 896s344-768 768-768 768 344 768 768z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('forkawesome-adjust', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" viewBox="0 0 1536 1536" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M768 1440V352c-300 0-544 244-544 544s244 544 544 544zm768-544c0 424-344 768-768 768S0 1320 0 896s344-768 768-768 768 344 768 768z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeForkAwesomeServiceProvider::class,
        ];
    }
}
