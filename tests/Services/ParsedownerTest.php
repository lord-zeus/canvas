<?php

use Canvas\Services\Parsedowner;

class ParsedownerTest extends PHPUnit_Framework_TestCase
{
    private $parsedowner;

    public function setup()
    {
        $this->parsedowner = new Parsedowner();
    }

    /**
     * @test
     * @dataProvider conversionsProvider
     */
    public function it_converts_markdown_to_html($value, $expected)
    {
        $this->assertEquals($expected, $this->parsedowner->toHTML($value));
    }

    public function conversionsProvider()
    {
        return [
            ['text', '<p>text</p>'],
            ["Header 1\n=======", '<h1>Header 1</h1>'],
            ['# Header 1', '<h1>Header 1</h1>'],
            ['## Header 2', '<h2>Header 2</h2>'],
            ['### Header 3', '<h3>Header 3</h3>'],
            ['#### Header 4', '<h4>Header 4</h4>'],
            ['##### Header 5', '<h5>Header 5</h5>'],
            ['###### Header 6', '<h6>Header 6</h6>'],
            ['`hello_world`', '<p><code>hello_world</code></p>'],
            ['``` <?php $var = "Php Code Blocks"; echo $var; ?> ```', '<p><code>&lt;?php $var = "Php Code Blocks"; echo $var; ?&gt;</code></p>'],
            ['*italics text*', '<p><em>italics text</em></p>'],
            ['_italics text_', '<p><em>italics text</em></p>'],
            ['**bold text**', '<p><strong>bold text</strong></p>'],
            ['__bold text__', '<p><strong>bold text</strong></p>'],
            ['---', '<hr />'],
            ['***', '<hr />'],
            ['>note', "<blockquote>\n<p>note</p>\n</blockquote>"],
            ['[Canvas](http://austintoddj.github.io/Canvas "Canvas")', '<p><a href="http://austintoddj.github.io/Canvas" title="Canvas">Canvas</a></p>'],
            ['Intra-word *emp*hasis', '<p>Intra-word <em>emp</em>hasis</p>'],
            ['~~Strikethrough~~', '<p><del>Strikethrough</del></p>'],
            ['![Canvas Logo](http://canvas.toddaustin.io/img/canvas-logo.gif)', '<p><img src="http://canvas.toddaustin.io/img/canvas-logo.gif" alt="Canvas Logo" /></p>'],
            ['- List Item', "<ul>\n<li>List Item</li>\n</ul>"],
            ['1. List Item', "<ol>\n<li>List Item</li>\n</ol>"],
            ['[Canvas](http://canvas.toddaustin.io)', '<p><a href="http://canvas.toddaustin.io">Canvas</a></p>'],
        ];
    }
}
