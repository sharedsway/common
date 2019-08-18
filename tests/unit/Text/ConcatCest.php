<?php namespace Sharedsway\Common\Test\Text;
use Sharedsway\Common\Test\UnitTester;
use Sharedsway\Common\Text;

class ConcatCest
{
    public function _before(UnitTester $I)
    {
    }

    /**
     * Tests Phalcon\Text :: concat()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     */
    public function textConcat(UnitTester $I)
    {
        $I->wantToTest('Text - concat()');
        // Test 1
        $actual   = Text::concat('/', '/tmp/', '/folder_1/', '/folder_2', 'folder_3/');
        $expected = '/tmp/folder_1/folder_2/folder_3/';
        $I->assertEquals($expected, $actual);

        // Test 2
        $actual   = Text::concat('.', '@test.', '.test2.', '.test', '.34');
        $expected = '@test.test2.test.34';
        $I->assertEquals($expected, $actual);
    }

}
