<?php

namespace syntax\oop;

use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    private Card $card;

    public function setUp(): void
    {
        $this->card = new Card('4', 'spades');
    }

    public function testGetNumber(): void
    {
        $actual = $this->card->getNumber();
        $this->assertEquals('4', $actual, 'NUmber should be <4>');
    }

    public function testGetSuit(): void
    {
        $actual = $this->card->getSuit();
        $this->assertEquals('spades', $actual, 'Suit should be <spades>');
    }

    public function matchingCardDataProvider(): array
    {
        return [
            [new Card('4', 'hearts'), true, 'should match'],
            [new Card('5', 'hearts'), false, 'should not match'],
            [new Card('4', 'clubs'), true, 'should not match'],
        ];
    }

    /**
     * @param  Card  $matchingCard
     * @param        $expetecd
     * @param        $msg
     *
     * @dataProvider matchingCardDataProvider
     */
    public function testIsInMatchingSet(Card $matchingCard, $expetecd, $msg): void
    {
//        $matchingCard = new Card('4', 'hearts');
//        $this->assertTrue($this->card->isInMatchingSet($matchingCard), '<4 of Spades> shoul match <4 of Hearts>');

        $this->assertEquals(
            $expetecd,
            $this->card->isInMatchingSet($matchingCard),
            '<$this->>card->getNumber() of ($this->getSuit())> {$msg}'
            ."<{$matchingCard->getNumber()} of {$matchingCard->getSuit()}>"
        );
    }
}