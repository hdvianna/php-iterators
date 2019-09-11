<?php

namespace hdvianna\Iterators;

use PHPUnit\Framework\TestCase;

class StackedTreeIteratorTest extends TestCase
{

    public function testEmptyTree()
    {
        $stackedTree = new StackedTreeIterator([], function ($node) {
            return $node['children'];
        });
        $this->_testValuesAndIterationNumber($stackedTree, 0);
    }

    public function testNullTree()
    {
        $stackedTree = new StackedTreeIterator(null, function ($node) {
            return $node['children'];
        });
        $this->_testValuesAndIterationNumber($stackedTree, 0);
    }

    public function testNextAndReset()
    {
        $tree = $this->createTestTree();
        $stackedTree = new StackedTreeIterator($tree, function ($node) {
            return $node['children'];
        });

        $this->_testValuesAndIterationNumber($stackedTree, 10);
        reset($stackedTree);
        $this->_testValuesAndIterationNumber($stackedTree, 10);
    }

    public function testKey()
    {
        $tree = $this->createTestTree();
        $stackedTree = new StackedTreeIterator($tree, function ($node) {
            return $node['children'];
        });

        $i = 0;
        foreach ($stackedTree as $key => $node) {
            $this->assertEquals($i, $key["iteration"], "Key has unexpected iteration");
            $this->assertEquals($node["depth"], $key["depth"], "Key has unexpected depth for node {$node['value']}");
            $i++;
        }
    }


    private function createTestTree()
    {
        return [
            "value" => 1,
            "depth" => 0,
            "children" => [
                [
                    "value" => 2,
                    "depth" => 1,
                    "children" => [
                        [
                            "value" => 3,
                            "depth" => 2,
                            "children" => []
                        ],
                        [
                            "value" => 4,
                            "depth" => 2,
                            "children" => []
                        ]
                    ]
                ],
                [
                    "value" => 5,
                    "depth" => 1,
                    "children" => [
                        [
                            "value" => 6,
                            "depth" => 2,
                            "children" => []
                        ],
                        [
                            "value" => 7,
                            "depth" => 2,
                            "children" => []
                        ],
                        [
                            "value" => 8,
                            "depth" => 2,
                            "children" => [
                                [
                                    "value" => 9,
                                    "depth" => 3,
                                    "children" => [
                                        [
                                            "value" => 10,
                                            "depth" => 4,
                                            "children" => []
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    private function _testValuesAndIterationNumber(StackedTreeIterator $stackedTree, int $expectedIterationNumber)
    {
        $i = 0;
        foreach ($stackedTree as $node) {
            $this->assertEquals(++$i, $node["value"], "Node has unexpected value");
        }
        $this->assertEquals($i, $expectedIterationNumber, "Items count different from the expected");
    }

    public function testDepth()
    {
        $stackedTree = new StackedTreeIterator([
            "depth" => 0,
            "children" => [
                ["depth" => 1, "children" => [
                    ["depth" => 2, "children" => [
                            ["depth" => 3, "children" => [
                                ["depth" => 4, "children" => [
                                    ["depth" => 5, "children" => [
                                        ["depth" => 6, "children" => [
                                            ["depth" => 7, "children" => []]
                                        ]]
                                    ]],
                                ]]
                            ]],
                        ]
                    ],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []]
                ]],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => [
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => [
                        ["depth" => 3, "children" => []],
                        ["depth" => 3, "children" => [
                            ["depth" => 4, "children" => []],
                            ["depth" => 4, "children" => []],
                            ["depth" => 4, "children" => []],
                            ["depth" => 4, "children" => []],
                            ["depth" => 4, "children" => []],
                            ["depth" => 4, "children" => []],
                            ["depth" => 4, "children" => []]
                        ]],
                        ["depth" => 3, "children" => []],
                        ["depth" => 3, "children" => []],
                        ["depth" => 3, "children" => []],
                        ["depth" => 3, "children" => []],
                        ["depth" => 3, "children" => []]
                    ]],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []]
                ]],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => []],
                ["depth" => 1, "children" => [
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => []],
                    ["depth" => 2, "children" => [
                        ["depth" => 3, "children" => [
                            ["depth" => 4, "children" => [
                                ["depth" => 5, "children" => [
                                    ["depth" => 6, "children" => [
                                        ["depth" => 7, "children" => []]
                                    ]]
                                ]],
                            ]]
                        ]],
                    ]]
                ]]
            ]
        ], function ($node) {
            return $node['children'];
        });

        $i = 0;
        foreach ($stackedTree as $key => $node) {
            $this->assertEquals($i, $key["iteration"], "Key has unexpected iteration");
            $this->assertEquals($node["depth"], $key["depth"], "Key has unexpected depth for node $i");
            $i++;
        }
    }


}
