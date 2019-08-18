<?php namespace Sharedsway\Common\Test\Text;
use Sharedsway\Common\Test\UnitTester;
use Sharedsway\Common\Text;

class UnderscoreCest
{
    public function _before(UnitTester $I)
    {
    }

    /**
     * Tests Phalcon\Text :: underscore()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textUnderscore(UnitTester $I)
    {
        $I->wantToTest('Text - underscore()');
        $expected = 'start_a_horse';
        $actual   = Text::underscore('start a horse');
        $I->assertEquals($expected, $actual);

        $expected = 'five_cats';
        $actual   = Text::underscore("five\tcats");
        $I->assertEquals($expected, $actual);

        $expected = 'look_behind';
        $actual   = Text::underscore(' look behind ');
        $I->assertEquals($expected, $actual);

        $expected = 'Awesome_Phalcon';
        $actual   = Text::underscore(" \t Awesome \t  \t Phalcon ");
        $I->assertEquals($expected, $actual);
    }

}
