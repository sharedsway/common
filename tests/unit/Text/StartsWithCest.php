<?php namespace Sharedsway\Common\Test\Unit\Text;
use Sharedsway\Common\Test\UnitTester;
use Sharedsway\Common\Text;

class StartsWithCest
{
    public function _before(UnitTester $I)
    {
    }

    /**
     * Tests Phalcon\Text :: startsWith()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textStartsWith(UnitTester $I)
    {
        $I->wantToTest('Text - startsWith()');
        $actual = Text::startsWith("Hello", "H");
        $I->assertTrue($actual);

        $actual = Text::startsWith("Hello", "He");
        $I->assertTrue($actual);

        $actual = Text::startsWith("Hello", "Hello");
        $I->assertTrue($actual);
    }

    /**
     * Tests Phalcon\Text :: startsWith() - empty strings
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textStartsWithEmpty(UnitTester $I)
    {
        $I->wantToTest('Text - startsWith() - empty strings');
        $actual = Text::startsWith("", "");
        $I->assertFalse($actual);
    }

    /**
     * Tests Phalcon\Text :: startsWith() - finding an empty string
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textStartsWithEmptySearchString(UnitTester $I)
    {
        $I->wantToTest('Text - startsWith() - search empty string');
        $actual = Text::startsWith("", "hello");
        $I->assertFalse($actual);
    }


    /**
     * Tests Phalcon\Text :: startsWith() - case insensitive flag
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textStartsWithCaseInsensitive(UnitTester $I)
    {
        $I->wantToTest('Text - startsWith() - case insensitive flag');
        $actual = Text::startsWith("Hello", "h");
        $I->assertTrue($actual);

        $actual = Text::startsWith("Hello", "he");
        $I->assertTrue($actual);

        $actual = Text::startsWith("Hello", "hello");
        $I->assertTrue($actual);
    }

    /**
     * Tests Phalcon\Text :: startsWith() - case sensitive flag
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textStartsWithCaseSensitive(UnitTester $I)
    {
        $I->wantToTest('Text - startsWith() - case sensitive flag');
        $actual = Text::startsWith("Hello", "hello", true);
        $I->assertTrue($actual);

        $actual = Text::startsWith("Hello", "hello", false);
        $I->assertFalse($actual);

        $actual = Text::startsWith("Hello", "h", false);
        $I->assertFalse($actual);
    }

}
