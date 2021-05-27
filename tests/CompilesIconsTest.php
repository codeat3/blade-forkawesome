<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
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
            <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M768 1440V352c-300 0-544 244-544 544s244 544 544 544zm768-544c0 424-344 768-768 768S0 1320 0 896s344-768 768-768 768 344 768 768z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('forkawesome-adjust', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M768 1440V352c-300 0-544 244-544 544s244 544 544 544zm768-544c0 424-344 768-768 768S0 1320 0 896s344-768 768-768 768 344 768 768z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('forkawesome-adjust', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M768 1440V352c-300 0-544 244-544 544s244 544 544 544zm768-544c0 424-344 768-768 768S0 1320 0 896s344-768 768-768 768 344 768 768z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-forkawesome.class', 'awesome');

        $result = svg('forkawesome-adjust')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M768 1440V352c-300 0-544 244-544 544s244 544 544 544zm768-544c0 424-344 768-768 768S0 1320 0 896s344-768 768-768 768 344 768 768z"/></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-forkawesome.class', 'awesome');

        $result = svg('forkawesome-adjust', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><path d="M768 1440V352c-300 0-544 244-544 544s244 544 544 544zm768-544c0 424-344 768-768 768S0 1320 0 896s344-768 768-768 768 344 768 768z"/></svg>
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
