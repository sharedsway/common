<?php namespace Sharedsway\Common\Test\Unit\Text;

use Codeception\Example;
use Sharedsway\Common\Test\UnitTester;
use Sharedsway\Common\Text;

class UncamelizeCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests

    /**
     * @dataProvider getSources
     * @param UnitTester $I
     * @param Example $example
     */
    public function tryToTest(UnitTester $I, Example $example)
    {
        $value    = $example[0];
        $expected = $example[1];
        $split    = $example[2];

        $res = Text::uncamelize($value, $split);
        $I->assertEquals($expected, $res);
    }


    public function getSources()
    {
        return [
            ['camelize', 'camelize', null],
            ['CameLiZe', 'came_li_ze', null],
            ['cAmeLize', 'c_ame_lize', null],
            ['_camelize', '_camelize', null],
            ['camelize_', 'camelize_', null],
            ['123camelize', '123camelize', null],
            ['c_a_m_e_l_i_z_e', 'c_a_m_e_l_i_z_e', null],
            ['Camelize', 'camelize', null],
            ['camel_ize', 'camel_ize', null],
            ['CameLize', 'came_lize', null],
            ["Camelize", 'camelize', null],
            ["=Camelize", '=_camelize', "_"],
            ["=Camelize", '=camelize', "="],
            ["Camelize", 'camelize', "_"],
            ["CameLiZe", 'came_li_ze', "_"],
            ["CameLiZe", 'came#li#ze', "#"],
            ["CameLiZe", 'came li ze', " "],
            ["CameLiZe", 'came.li.ze', "."],
            ["CameLiZe", 'came-li-ze', "-"],
            ["CAMELIZE", 'c/a/m/e/l/i/z/e', "/"],

        ];
    }
}
