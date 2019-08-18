<?php namespace Sharedsway\Common\Test\Text;
use Sharedsway\Common\Test\UnitTester;
use Sharedsway\Common\Text;

class ReduceSlashesCest
{
    public function _before(UnitTester $I)
    {
    }

    /**
     * Tests Phalcon\Text :: reduceSlashes()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textReduceSlashes(UnitTester $I)
    {
        $I->wantToTest('Text - reduceSlashes()');
        $expected = 'app/controllers/IndexController';
        $actual   = Text::reduceSlashes('app/controllers//IndexController');
        $I->assertEquals($expected, $actual);

        $expected = 'http://foo/bar/baz/buz';
        $actual   = Text::reduceSlashes('http://foo//bar/baz/buz');
        $I->assertEquals($expected, $actual);

        $expected = 'php://memory';
        $actual   = Text::reduceSlashes('php://memory');
        $I->assertEquals($expected, $actual);

        $expected = 'http/https';
        $actual   = Text::reduceSlashes('http//https');
        $I->assertEquals($expected, $actual);
    }

}
