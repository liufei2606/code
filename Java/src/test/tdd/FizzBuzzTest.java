package test.tdd;

import main.tdd.FizzBuzz;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.assertEquals;


class FizzBuzzTest {

    @Test
    public void get_except_result(){
        String result = FizzBuzz.handleSignleDigit(6);
        assertEquals('6',result);
    }

}