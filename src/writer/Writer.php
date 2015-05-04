<?php
namespace SeleniumPhp\Writer;

/**
 * Class Writer
 * @package SeleniumPhp\Writer
 */
class Writer implements WriterInterface
{
    /**
     * @param $value
     * @param string $newline
     * @return mixed
     */
    public static function write($value, $newline = PHP_EOL)
    {
        fwrite(STDERR, print_r($value, true) . (isset($newline) ? $newline : ''));
    }
}
