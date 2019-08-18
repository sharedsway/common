<?php
/**
 * Created by PhpStorm.
 * User: debian
 * Date: 19-8-18
 * Time: 下午5:32
 */
namespace Sharedsway\Common;
abstract class Text
{

    const RANDOM_ALNUM = 0;

    const RANDOM_ALPHA = 1;

    const RANDOM_HEXDEC = 2;

    const RANDOM_NUMERIC = 3;

    const RANDOM_NOZERO = 4;

    const RANDOM_DISTINCT = 5;

    /**
     * Converts strings to camelize style
     *
     * <code>
     * echo Sharedsway\Common\Text::camelize("coco_bongo"); // CocoBongo
     * echo Sharedsway\Common\Text::camelize("co_co-bon_go", "-"); // Co_coBon_go
     * echo Sharedsway\Common\Text::camelize("co_co-bon_go", "_-"); // CoCoBonGo
     * </code>
     */
    /**
     * Converts strings to camelize style
     *
     * <code>
     * echo Sharedsway\Common\Text::camelize("coco_bongo"); // CocoBongo
     * echo Sharedsway\Common\Text::camelize("co_co-bon_go", "-"); // Co_coBon_go
     * echo Sharedsway\Common\Text::camelize("co_co-bon_go", "_-"); // CoCoBonGo
     * echo Sharedsway\Common\Text::camelize("co_co-bon_go"); // CoCoBonGo
     * </code>
     *
     * @param string $str
     * @param null $delimiter
     * @return string
     */
    public static function camelize(string $str, $delimiter = null): string
    {

        if (!$delimiter) $delimiter = '_-';
        $str = self::lower($str);
        foreach (str_split($delimiter) as $char) {
            $str = str_replace($char, ' ', $str);
        }
        $str = ucwords($str);
        $str = str_replace(' ', '', $str);

        return $str;
    }

    /**
     * Uncamelize strings which are camelized
     *
     * <code>
     * echo Sharedsway\Common\Text::uncamelize("CocoBongo"); // coco_bongo
     * echo Sharedsway\Common\Text::uncamelize("CocoBongo", "-"); // coco-bongo
     * </code>
     * @param string $str
     * @param string|null $delimiter
     * @return string
     */
    public static function uncamelize(string $str, string $delimiter = null): string
    {
        if (!$delimiter) $delimiter = '_';
        $start = '';
        $end   = '';
        if (preg_match('/^(\\' . $delimiter . '+)/', $str, $matches)) $start = $matches[1];
        if (preg_match('/(\\' . $delimiter . '+)$/', $str, $matches)) $end = $matches[1];

        $str = preg_replace('/([A-Z]{1})/', $delimiter . '$1', $str);
        $str = $start . trim($str, $delimiter) . $end; //this row is error
        return self::lower($str);
    }

    /**
     * Adds a number to a string $or increment that number if it already is defined
     *
     * <code>
     * echo Sharedsway\Common\Text::increment("a"); // "a_1"
     * echo Sharedsway\Common\Text::increment("a_1"); // "a_2"
     * </code>
     * @param string $str
     * @param string $separator
     * @return string
     */
    public static function increment(string $str, string $separator = "_"): string
    {
        $parts = explode($separator, $str);
        if (isset($parts[1])) {
            $number = intval($parts[1]);
            $number++;
        } else {
            $number = 1;
        }

        return $parts[0] . $separator . $number;
    }

    /**
     * Generates a random string $based on the given type. Type is one of the RANDOM_* constants
     *
     * <code>
     * use Sharedsway\Common\Text;
     *
     * // "aloiwkqz"
     * echo Text::random(Text::RANDOM_ALNUM);
     * </code>
     * @param int $type
     * @param int $length
     * @return string
     */
    public static function random(int $type = 0, int $length = 8): string
    {
        $str = "";

        switch ($type) {

            case Text::RANDOM_ALPHA:
                $pool = array_merge(range("a", "z"), range("A", "Z"));
                break;

            case Text::RANDOM_HEXDEC:
                $pool = array_merge(range(0, 9), range("a", "f"));
                break;

            case Text::RANDOM_NUMERIC:
                $pool = range(0, 9);
                break;

            case Text::RANDOM_NOZERO:
                $pool = range(1, 9);
                break;

            case Text::RANDOM_DISTINCT:
                $pool = str_split("2345679ACDEFHJKLMNPRSTUVWXYZ");
                break;

            default:
                // Default type \Sharedsway\Common\Text::RANDOM_ALNUM
                $pool = array_merge(range(0, 9), range("a", "z"), range("A", "Z"));
                break;
        }

        $end = count($pool) - 1;

        while (strlen($str) < $length) {
            $str .= $pool[mt_rand(0, $end)];
        }

        return $str;
    }


    /**
     * Check if a string $starts with a given string
     *
     * <code>
     * echo Sharedsway\Common\Text::startsWith("Hello", "He"); // true
     * echo Sharedsway\Common\Text::startsWith("Hello", "he", false); // false
     * echo Sharedsway\Common\Text::startsWith("Hello", "he"); // true
     * </code>
     * @param string $str
     * @param string $start
     * @param bool $ignoreCase
     * @return bool
     */
    public static function startsWith(string $str, string $start, bool $ignoreCase = true): bool
    {
        if ($ignoreCase === true) {
            $str   = self::lower($str);
            $start = self::lower($start);
        }

        //coded from laravel
        foreach ((array)$start as $v) {
            if ($v !== '' && substr($str, 0, strlen($v)) === (string)$v) {
                return true;
            }
        }
        return false;
    }


    /**
     * Check if a string $ends with a given string
     *
     * <code>
     * echo Sharedsway\Common\Text::endsWith("Hello", "llo"); // true
     * echo Sharedsway\Common\Text::endsWith("Hello", "LLO", false); // false
     * echo Sharedsway\Common\Text::endsWith("Hello", "LLO"); // true
     * </code>
     * @param string $str
     * @param string $end
     * @param bool $ignoreCase
     * @return bool
     */
    public static function endsWith(string $str, string $end, bool $ignoreCase = true): bool
    {
        if ($ignoreCase === true) {
            $str = self::lower($str);
            $end = self::lower($end);
        }

        //coded from laravel
        foreach ((array)$end as $v) {
            if ($v !== '' && substr($str, -strlen($v)) === (string)$v) {
                return true;
            }
        }
        return false;
    }


    /**
     * Lowercases a string, this function makes use of the mbstring $extension if available
     *
     * <code>
     * echo Sharedsway\Common\Text::lower("HELLO"); // hello
     * </code>
     * @param string $str
     * @param string $encoding required mbstring
     * @return string
     */
    public static function lower(string $str, string $encoding = "UTF-8"): string
    {
        /**
         * 'lower' checks for the mbstring $extension to make a correct lowercase transformation
         */
        if (function_exists("mb_strtolower")) {
            return mb_strtolower($str, $encoding);
        }
        return strtolower($str);
    }

    /**
     * Uppercases a string, this function makes use of the mbstring $extension if available
     *
     * <code>
     * echo Sharedsway\Common\Text::upper("hello"); // HELLO
     * </code>
     * @param string $str
     * @param string $encoding required ext-mbstring
     * @return string
     */
    public static function upper(string $str, string $encoding = "UTF-8"): string
    {
        /**
         * 'upper' checks for the mbstring $extension to make a correct uppercase transformation
         */
        if (function_exists("mb_strtoupper")) {
            return mb_strtoupper($str, $encoding);
        }
        return strtoupper($str);
    }


    /**
     * Reduces multiple slashes in a string $to single slashes
     *
     * <code>
     * echo Sharedsway\Common\Text::reduceSlashes("foo//bar/baz"); // foo/bar/baz
     * echo Sharedsway\Common\Text::reduceSlashes("http://foo.bar///baz/buz"); // http://foo.bar/baz/buz
     * </code>
     * @param string $str
     * @return string
     */
    public static function reduceSlashes(string $str): string
    {
        return preg_replace("#(?<!:)//+#", "/", $str);
    }


    /**
     * Concatenates strings using the separator only once without duplication in places concatenation
     *
     * <code>
     * $str = Sharedsway\Common\Text::concat(
     *     "/",
     *     "/tmp/",
     *     "/folder_1/",
     *     "/folder_2",
     *     "folder_3/"
     * );
     *
     * // /tmp/folder_1/folder_2/folder_3/
     * echo $str;
     * </code>
     *
     * @param string $separator
     * @param string $a
     * @param string $b
     * @param string ...N
     * @return string
     */
    public static function concat(): string
    {
        /**
         * TODO:
         * Remove after solve https://github.com/phalcon/zephir/issues/938,
         * and also replace line 214 to 213
         */
        //var separator, a, b;
        $separator = func_get_arg(0);
        $a         = func_get_arg(1);
        $b         = func_get_arg(2);


        //END


        if (func_num_args() > 3) {
            foreach (array_slice(func_get_args(), 3) as $c) {
                $b = rtrim($b, $separator) . $separator . ltrim($c, $separator);
            }
        }

        return rtrim($a, $separator) . $separator . ltrim($b, $separator);
    }

    /**
     * Generates random text in accordance with the template
     *
     * <code>
     * // Hi my name is a Bob
     * echo Sharedsway\Common\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!");
     *
     * // Hi my name is a Jon
     * echo Sharedsway\Common\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!");
     *
     * // Hello my name is a Bob
     * echo Sharedsway\Common\Text::dynamic("{Hi|Hello}, my name is a {Bob|Mark|Jon}!");
     *
     * // Hello my name is a Zyxep
     * echo Sharedsway\Common\Text::dynamic("[Hi/Hello], my name is a [Zyxep/Mark]!", "[", "]", "/");
     * </code>
     * @param string $text
     * @param string $leftDelimiter
     * @param string $rightDelimiter
     * @param string $separator
     * @return string
     */
    public static function dynamic(string $text, string $leftDelimiter = "{", string $rightDelimiter = "}", string $separator = "|"): string
    {
        //var ldS, rdS, pattern, matches, match, words, word, sub;

        if (substr_count($text, $leftDelimiter) !== substr_count($text, $rightDelimiter)) {
            throw new \RuntimeException("Syntax error in string \"" . $text . "\"");
        }

        $ldS     = preg_quote($leftDelimiter);
        $rdS     = preg_quote($rightDelimiter);
        $pattern = "/" . $ldS . "([^" . $ldS . $rdS . "]+)" . $rdS . "/";
        $matches = [];

        if (!preg_match_all($pattern, $text, $matches, 2)) {
            return $text;
        }

        if (is_array($matches)) {
            foreach ($matches as $match) {
                if (!isset ($match[0]) || !isset ($match[1])) {
                    continue;
                }

                $words = explode($separator, $match[1]);
                $word  = $words[array_rand($words)];
                $sub   = preg_quote($match[0], $separator);
                $text  = preg_replace("/" . $sub . "/", $word, $text, 1);
            }
        }

        return $text;
    }


    /**
     * Makes a phrase underscored instead of spaced
     *
     * <code>
     * echo Sharedsway\Common\Text::underscore("look behind"); // "look_behind"
     * echo Sharedsway\Common\Text::underscore("Awesome Phalcon"); // "Awesome_Phalcon"
     * </code>
     * @param string $text
     * @return string
     */
    public static function underscore(string $text): string
    {
        return preg_replace("#\s+#", "_", trim($text));
    }

    /**
     * Makes an underscored or dashed phrase human-readable
     *
     * <code>
     * echo Sharedsway\Common\Text::humanize("start-a-horse"); // "start a horse"
     * echo Sharedsway\Common\Text::humanize("five_cats"); // "five cats"
     * </code>
     * @param string $text
     * @return string
     */
    public static function humanize(string $text): string
    {
        return preg_replace("#[_-]+#", " ", trim($text));
    }
}
