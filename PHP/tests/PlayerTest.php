<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class PlayerTest
 *
 * @package Tests
 * @Disbaled
 */
class PlayerTest extends TestCase
{
//    private Player $player;
    private string $hand;

    public function testDrawCard()
    {
        $deck = $this->getMockClass('CardCoolection');
        $deck->expects($this->once())->method('moveTopCardTo')->with($this->identicalTo($this->hand));
    }

    public function testTakeCardFPlayer()
    {
        $otherHand = $this->getMockClass('CardCollection');
//        $otherPlayer = $this->getMockClass('Player', [],, ['Jane Smith', $otherHand]);
        $card = $this->getMockClass('Card', [], ['A', 'Spades']);

//        $otherPlayer->expected($this->once())->method('getCard')->with($this->equalTo(4))->will($this->returnValue($card));
    }

    protected function setUp(): void
    {
        $this->hand = $this->getMockClass('CardCollection');
//        $this->player = new Player('John Smith', $this->hand);
    }
}
