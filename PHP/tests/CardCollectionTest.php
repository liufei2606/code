<?php


namespace Test;

use PHPUnit\Framework\TestCase;
use syntax\oop\Card;

class CardCollectionTest extends TestCase
{
    /**
     * @var CardCollectionTest
     */
    private CardCollectionTest $cardCollection;

    protected function setUp(): void
    {
        $this->cardCollection = new CardCollectionTest();
    }

    public function testCountOnEmpty(): void
    {
        $this->assertEquals(0, $this->cardCollection->count());
    }

    /**
     * @return int
     * @depends  testCountOnEmpty
     */
    public function testAddCard()
    {
        $this->cardCollection->addCard(new Card('A', 'Spades'));
        $this->cardCollection->addCard(new Card('2', 'Spades'));

        return $this->cardCollection->count();
    }

    /**
     * @param  CardCollection  $cardCollection
     *
     * @depends testAddCard
     */
    public function testGetTopCard(CardCollection $cardCollection)
    {
        $card = $cardCollection->getTopCard();
        $this->assertEquals(new Card('2', 'Spades'), $card);
    }
}
