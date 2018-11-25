<?php

use Generator\Context;

/**
 * Only use for get one context
 */
abstract class BootstrapContext
{

    /**
     * @static

     * @var Context|null
     */
    protected static $context;

    /**
     * Create context if not exist
     *
     * @static

     * @return void
     */
    public static function get_context()
    {
        if (null !== self::$context) {
            return self::$context;
        }

        self::$context = new Context();

        $files      = array_diff(scandir(__DIR__ . '/Services'), [ '..', '.' ]);
        $services = [];
        foreach ($files as $filename) {
            $services[] = '\\Generator\\Services\\' . str_replace('.php', '', $filename);
        }

        self::$context->set_services($services);
        
        return self::$context;
    }
}
