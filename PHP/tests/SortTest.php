<?php

namespace Tests;

use Algorithms\sort\Bubble;
use Algorithms\sort\Counting;
use Algorithms\sort\Heap;
use Algorithms\sort\Insertion;
use Algorithms\sort\Merge;
use Algorithms\sort\Quick;
use Algorithms\sort\Selection;
use Algorithms\sort\Shell;
use PHPUnit\Framework\TestCase;

class SortTest extends TestCase
{

    public function testBubble(): void
    {
        self::assertEquals([1, 2, 3, 4, 5], Bubble::sort([5, 4, 3, 2, 1]));
    }

    public function testShell()
    {
        self::assertEquals([1, 2, 3, 4, 5], Shell::sort([5, 4, 3, 2, 1]));
    }


    public function testCounting(): void
    {
        self::assertEquals([1, 2, 3, 4, 5], Counting::sort([5, 4, 3, 2, 1]));
    }


    public function testMerge(): void
    {
        self::assertEquals([1, 2, 3, 4, 5], Merge::sort([5, 4, 3, 2, 1]));
    }


    public function testHeap(): void
    {
        self::assertEquals([1, 2, 3, 4, 5], Heap::sort([5, 4, 3, 2, 1]));
    }


    public function testSelection(): void
    {
        self::assertEquals([1, 2, 3, 4, 5], Selection::sort([5, 4, 3, 2, 1]));
    }


    public function testInstertion(): void
    {
        self::assertEquals([1, 2, 3, 4, 5], Insertion::sort([5, 4, 3, 2, 1]));
    }


    public function testQuick(): void
    {
        self::assertEquals([1, 2, 3, 4, 5], Quick::sort([5, 4, 3, 2, 1]));
    }
}
