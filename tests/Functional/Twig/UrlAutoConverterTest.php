<?php

namespace Linnit\Tests\Functional\Twig;

use PHPUnit\Framework\TestCase;
use Linnit\Twig\Extension\UrlAutoConverterExtension;

class UrlAutoConverterTest extends TestCase
{
    public function testEscapedHtml()
    {
        if (method_exists('\Twig_Environment', 'createTemplate')) { // twig > 2.0
            $twig = new \Twig_Environment();
            $twig->addExtension(new UrlAutoConverterExtension());

            $body = 'Hello <a href="javascript:alert(\'ups\');">name</a>!';
            $expected = 'Hello &lt;a href=&quot;javascript:alert(&#039;ups&#039;);&quot;&gt;name&lt;/a&gt;!';

            $template = $twig->createTemplate('{{ body | converturls }}');

            $this->assertEquals($expected, $template->render(array('body' => $body)));
        }
    }
}
