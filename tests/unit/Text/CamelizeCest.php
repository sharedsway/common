<?php namespace Sharedsway\Common\Test\Unit\Text;
use Sharedsway\Common\Test\UnitTester;

use Codeception\Example;
use Sharedsway\Common\Text;

class CamelizeCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests

    /**
     * @dataProvider getSource
     * @param UnitTester $I
     * @param Example $example
     */
    public function tryToTest(UnitTester $I, Example $example)
    {
        $value    = $example[0];
        $expected = $example[1];
        $split    = $example[2];

        $res = Text::camelize($value, $split);
        $I->assertEquals($expected, $res);
    }

    private function getSource()
    {
        return [
            ['camelize', 'Camelize', null],
            ['CameLiZe', 'Camelize', null],
            ['cAmeLize', 'Camelize', null],
            ['123camelize', '123camelize', null],
            ['c_a_m_e_l_i_z_e', 'CAMELIZE', null],
            ['Camelize', 'Camelize', null],
            ['camel_ize', 'CamelIze', null],
            ['CameLize', 'Camelize', null],
            ["c_a-m_e-l_i-z_e", 'CAMELIZE', null],
            ["came_li_ze", 'CameLiZe', null],
            ["=_camelize", '=Camelize', "_"],
            ["camelize", 'Camelize', "_"],
            ["came_li_ze", 'CameLiZe', "_"],
            ["came#li#ze", 'CameLiZe', "#"],
            ["came li ze", 'CameLiZe', " "],
            ["came.li^ze", 'CameLiZe', ".^"],
            ["c_a-m_e-l_i-z_e", 'CAMELIZE', "-_"],
            ["came.li.ze", 'CameLiZe', "."],
            ["came-li-ze", 'CameLiZe', "-"],
            ["c+a+m+e+l+i+z+e", 'CAMELIZE', "+"],

        ];
    }
}
