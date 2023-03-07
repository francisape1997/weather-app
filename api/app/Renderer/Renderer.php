<?php

namespace App\Renderer;

/**
 * class Renderer
 * @package App\Renderer
 */
abstract class Renderer
{
    abstract function render(array $class) : array;

    /**
     * @param $classes
     * @return array
     */
    public function renderList($classes): array
    {
        $buffer = [];
        foreach ($classes as $class) {
            $buffer[] = $this->render($class);
        }

        return $buffer;
    }
}
