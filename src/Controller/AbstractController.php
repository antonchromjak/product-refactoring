<?php

namespace App\Controller;

abstract class AbstractController
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render()
    {
        $template = $this->getName() . ".html";
        $data = array_merge(
            [
                'type' => $this->getName(),
            ],
            $this->getData()
        );

        echo $this->twig->render($template, $data);
    }

    abstract protected function getName();
    abstract protected function getData();
}
