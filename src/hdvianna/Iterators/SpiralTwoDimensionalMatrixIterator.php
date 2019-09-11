<?php

namespace hdvianna\Iterators;


class SpiralTwoDimensionalMatrixIterator implements \Iterator
{

    private $matrix;

    private $i;
    private $j;

    private $startI;
    private $startJ;

    private $passed = 0;
    private $increment;

    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
    }

    public function current()
    {
        return $this->matrix[$this->i][$this->j];
    }

    public function next() : void
    {
        if ($this->increment) {
            if ($this->j < $this->endJ) {
                $this->j++;
            } elseif($this->i < $this->endI) {
                $this->i++;
            }
            if ($this->i === $this->endI && $this->j === $this->endJ){
                $this->increment = false;
            }
        } else {
            if ($this->j > $this->startJ) {
                $this->j--;
            } elseif($this->i > $this->startI) {
                $this->i--;
            }
            if ($this->i === $this->startI && $this->j === $this->startJ){
                $this->jump();
            }
        }
        $this->passed++;
    }

    private function jump() : void {
        $this->increment = true;

        $this->startI++;
        $this->i = $this->startI;
        $this->endI = count($this->matrix) - ($this->i + 1);

        $this->startJ++;
        $this->j = $this->startJ;
        $this->endJ = count($this->matrix[$this->i]) - ($this->j + 1);
    }

    public function key()
    {
        return ["i" => $this->i, "j" => $this->j];
    }

    public function valid() : bool
    {
        $n = (count($this->matrix) * count($this->matrix[0]));
        return $this->passed < $n;
    }

    public function rewind() : void
    {
        $this->startI = -1;
        $this->startJ = -1;
        $this->jump();
        $this->passed = 0;
    }

}