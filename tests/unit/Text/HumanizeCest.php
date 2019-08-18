<?php namespace Sharedsway\Common\Test\Text;
use Sharedsway\Common\Test\UnitTester;
use Sharedsway\Common\Text;

class HumanizeCest
{
    public function _before(UnitTester $I)
    {
    }

    /**
     * Tests Phalcon\Text :: humanize()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textHumanize(UnitTester $I)
    {
        $I->wantToTest('Text - humanize()');
        $expected = 'start a horse';
        $actual   = Text::humanize('start_a_horse');
        $I->assertEquals($expected, $actual);

        $expected = 'five cats';
        $actual   = Text::humanize('five-cats');
        $I->assertEquals($expected, $actual);

        $expected = 'kittens are cats';
        $actual   = Text::humanize('kittens-are_cats');
        $I->assertEquals($expected, $actual);

        $expected = 'Awesome Phalcon';
        $actual   = Text::humanize(" \t Awesome-Phalcon \t ");
        $I->assertEquals($expected, $actual);
    }

}
