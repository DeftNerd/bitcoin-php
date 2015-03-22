<?php

namespace BitWasp\Bitcoin\Crypto\EcAdapter;


use BitWasp\Bitcoin\Math\Math;
use Mdanter\Ecc\GeneratorPoint;

class EcAdapterFactory
{
    /**
     * @var PhpEcc|Secp256k1
     */
    private static $adapter;

    /**
     * @param Math $math
     * @param GeneratorPoint $generator
     * @return PhpEcc|Secp256k1
     */
    public static function getAdapter(Math $math, GeneratorPoint $generator)
    {
        if (self::$adapter !== null) {
            return self::$adapter;
        }

        if (extension_loaded('secp256k1')) {
            self::$adapter = new Secp256k1($math, $generator);
        } else {
            self::$adapter = new PhpEcc($math, $generator);
        }

        return self::$adapter;
    }
}