<?php

namespace hdvianna\Iterators;

class StackedTreeIterator implements \Iterator
{
    private $root;
    private $current;
    private $stack;
    private $childrenCallback;
    private $iteration;
    private $depth;
    private $checkChildrenToReduceDepth;

    public function __construct($root, $childrenCallback)
    {
        $this->root = $root;
        $this->childrenCallback = $childrenCallback;
    }

    public function current()
    {
        return $this->current;
    }

    public function next()
    {
        $this->iteration++;
        $children = $this->childrenCallback->call($this, $this->current);

        if ($this->checkChildrenToReduceDepth && count($children) === 0) {
            $this->depth--;
        }
        $this->checkChildrenToReduceDepth = false;

        $this->current = array_shift($children);
        if ($this->current) {
            $this->stack[] = $children;
            $this->depth++;
        } else {
            $top = array_pop($this->stack);
            if ($top) {
                $this->current = array_shift($top);
                if (count($top) > 0) {
                    $this->stack[] = $top;
                } else {
                    $this->checkChildrenToReduceDepth = true;
                }
            }
        }
    }

    public function key()
    {
        return ["iteration" => $this->iteration, "depth" => $this->depth];
    }

    public function valid()
    {
        return $this->current == true;
    }

    public function rewind()
    {
        $this->current = $this->root;
        $this->stack = [];
        $this->iteration = 0;
        $this->depth = 0;
        $this->checkChildrenToReduceDepth = false;
    }

}