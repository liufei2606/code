package org.codingjoko.data;

import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.*;

public class FizzBuzzTest {

    @Test
    public void ofTest() {
        assertEquals("Fizz", new FizzBuzz().of(3));
        assertEquals("Buzz", new FizzBuzz().of(25));
        assertEquals("FizzBuzz", new FizzBuzz().of(45));
        assertEquals("1", new FizzBuzz().of(1));
        assertEquals("44", new FizzBuzz().of(44));
    }
}
