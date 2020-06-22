package test.tdd;

import static org.junit.jupiter.api.Assertions.assertEquals;

import main.tdd.Calculator;
import example.util.Calculator;

import org.junit.jupiter.api.Test;

class CalculatorTest {

    private final Calculator calculator = new Calculator();

    @Test
    void addition() {
        assertEquals(2, calculator.add(1, 1));
    }

}