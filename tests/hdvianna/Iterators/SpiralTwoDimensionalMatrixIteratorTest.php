<?php

namespace hdvianna\Iterators;

use PHPUnit\Framework\TestCase;

class SpiralTwoDimensionalMatrixIteratorTest extends TestCase
{

    public function testMatrix_1x1()
    {
        $i = 1;
        $spiralMatrixIterator = new SpiralTwoDimensionalMatrixIterator([[1]]);
        foreach ($spiralMatrixIterator as $key => $item) {
            $this->assertEquals($i, $item, "Failed to validate iteration value.");
            $i++;
        }
        $this->assertEquals($i, 2, "Failed to validate iteration count.");
    }

    public function testMatrix_3x3()
    {
        $i = 1;
        $spiralMatrixIterator = new SpiralTwoDimensionalMatrixIterator([[1, 2, 3], [8, 9, 4], [7, 6, 5]]);
        foreach ($spiralMatrixIterator as $key => $item) {
            $this->assertEquals($i, $item, "Failed to validate iteration value.");
            $i++;
        }
        $this->assertEquals($i, 10, "Failed to validate iteration count.");
    }

    public function testMatrix_6x6()
    {
        $i = 1;
        $spiralMatrixIterator = new SpiralTwoDimensionalMatrixIterator([
            [1, 2, 3, 4, 5, 6],
            [20, 21, 22, 23, 24, 7],
            [19, 32, 33, 34, 25, 8],
            [18, 31, 36, 35, 26, 9],
            [17, 30, 29, 28, 27, 10],
            [16, 15, 14, 13, 12, 11]
        ]);
        foreach ($spiralMatrixIterator as $key => $item) {
            $this->assertEquals($i, $item, "Failed to validate iteration value.");
            $i++;
        }
        $this->assertEquals($i, 37, "Failed to validate iteration count.");
    }

    public function testMatrixReset_4x4()
    {
        $i = 1;
        $spiralMatrixIterator = new SpiralTwoDimensionalMatrixIterator([
            [1,2,3,4],
            [12,13,14,5],
            [11,16,15,6],
            [10,9,8,7]
        ]);
        foreach ($spiralMatrixIterator as $key => $item) {
            $this->assertEquals($i, $item, "Failed to validate iteration value.");
            $i++;
        }
        $this->assertEquals($i, 17, "Failed to validate iteration count.");

        $i = 1;
        reset($spiralMatrixIterator);
        foreach ($spiralMatrixIterator as $key => $item) {
            $this->assertEquals($i, $item, "Failed to validate iteration value.");
            $i++;
        }
        $this->assertEquals($i, 17, "Failed to validate iteration count.");

    }

    public function testMatrix_4x5()
    {
        $i = 1;
        $spiralMatrixIterator = new SpiralTwoDimensionalMatrixIterator([
            [1, 2, 3, 4, 5],
            [14, 15, 16, 17, 6],
            [13, 20, 19, 18, 7],
            [12, 11, 10, 9, 8]
        ]);
        foreach ($spiralMatrixIterator as $key => $item) {
            $this->assertEquals($i, $item, "Failed to validate iteration value.");
            $i++;
        }
        $this->assertEquals($i, 21, "Failed to validate iteration count.");
    }

    public function testMatrix_2x3()
    {
        $i = 1;
        $spiralMatrixIterator = new SpiralTwoDimensionalMatrixIterator([
            [1, 2, 3 ],
            [6, 5, 4]
        ]);
        foreach ($spiralMatrixIterator as $key => $item) {
            $this->assertEquals($i, $item, "Failed to validate iteration value.");
            $i++;
        }
        $this->assertEquals($i, 7, "Failed to validate iteration count.");
    }

    public function testMatrix_3x2()
    {
        $i = 1;
        $spiralMatrixIterator = new SpiralTwoDimensionalMatrixIterator([
            [1, 2],
            [6, 3],
            [5, 4]
        ]);
        foreach ($spiralMatrixIterator as $key => $item) {
            $this->assertEquals($i, $item, "Failed to validate iteration value.");
            $i++;
        }
        $this->assertEquals($i, 7, "Failed to validate iteration count.");
    }


}
