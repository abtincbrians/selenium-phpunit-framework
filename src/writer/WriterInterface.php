<?php
namespace SeleniumPhp\Writer;

/**
 * Interface WriterInterface
 * @package SeleniumPhp\Writer
 */
Interface WriterInterface
{
    /**
     * @param $value
     * @param string $newline
     * @return mixed
     */
    public static function write($value, $newline = PHP_EOL);
}
