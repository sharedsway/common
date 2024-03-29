<?php namespace Sharedsway\Common\Test\Unit\Text;
use Sharedsway\Common\Test\UnitTester;
use Sharedsway\Common\Text;

class IncrementCest
{
    public function _before(UnitTester $I)
    {
    }

    /**
     * Tests Phalcon\Text :: increment() - string
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textIncrementSimpleString(UnitTester $I)
    {
        $I->wantToTest('Text - increment() - string');
        $source   = 'file';
        $expected = 'file_1';
        $actual   = Text::increment($source);
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests Phalcon\Text :: increment() - already incremented string
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textIncrementAlreadyIncremented(UnitTester $I)
    {
        $I->wantToTest('Text - increment() - already incremented string');
        $source   = 'file_1';
        $expected = 'file_2';
        $actual   = Text::increment($source);
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests Phalcon\Text :: increment() - already incremented string twice
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textIncrementAlreadyIncrementedTwice(UnitTester $I)
    {
        $I->wantToTest('Text - increment() - already incremented string twice');
        $source   = 'file_2';
        $expected = 'file_3';
        $actual   = Text::increment($source);
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests Phalcon\Text :: increment() - string with underscore
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textIncrementStringWithUnderscore(UnitTester $I)
    {
        $I->wantToTest('Text - increment() - string with underscore');
        $source   = 'file_';
        $expected = 'file_1';
        $actual   = Text::increment($source);
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests Phalcon\Text :: increment() - string with a space at the end
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textIncrementStringWithSpace(UnitTester $I)
    {
        $I->wantToTest('Text - increment() - string with a space at the end');
        $source   = 'file ';
        $expected = 'file _1';
        $actual   = Text::increment($source);
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests Phalcon\Text :: increment() - different separator
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textIncrementStringWithDifferentSeparator(UnitTester $I)
    {
        $I->wantToTest('Text - increment() - string with different separator');
        $source   = 'file';
        $expected = 'file-1';
        $actual   = Text::increment($source, '-');
        $I->assertEquals($expected, $actual);
    }
}
