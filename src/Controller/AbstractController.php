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
        $name = $this->getName();
        $template = "$name.html";
        $data = array_merge(
            [
                'type' => $name,
            ],
            $this->getData()
        );

        echo $this->twig->render($template, $data);
    }

    protected function getName(){
        return strtolower(str_replace("Controller","",(new \ReflectionClass($this))->getShortName()));
    }

    abstract protected function getData();
}
