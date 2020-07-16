package tdd;

import main.tdd.MathTools;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class MathToolsTest {
    @Test
    public void testConvertToDecimalSuccess() {
        double result = MathTools.convertToDecimal(3, 4);
        Assertions.assertEquals(0.75, result);


    }

    // @Test
    // public void testConvertToDecimalInvalidDenominator() {
    //     Assertions.assertThrows(IllegalArgumentException.class, () -> MathTools.convertToDecimal(3, 0));
    // }
}
