<?php

declare(strict_types=1);

namespace DMS\PHPUnitExtensions\ArraySubset;

use ArrayAccess;
use DMS\PHPUnitExtensions\ArraySubset\Constraint\ArraySubset;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\Assert as PhpUnitAssert;
use PHPUnit\Framework\ExpectationFailedException;

use function is_array;

trait ArraySubsetAsserts
{
    /**
     * Asserts that an array has a specified subset.
     *
     * @param array|ArrayAccess|mixed[] $subset
     * @param array|ArrayAccess|mixed[] $array
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public static function assertArraySubset($subset, $array, bool $checkForObjectIdentity = false, string $message = ''): void
    {
        if (! (is_array($subset) || $subset instanceof ArrayAccess)) {
            throw new InvalidArgumentException('Argument #1 $subset of assertArraySubset() must be array or ArrayAccess.');
        }

        if (! (is_array($array) || $array instanceof ArrayAccess)) {
            throw new InvalidArgumentException('Argument #2 array of assertArraySubset() must be array or ArrayAccess.');
        }

        $constraint = new ArraySubset($subset, $checkForObjectIdentity);
        PhpUnitAssert::assertThat($array, $constraint, $message);
    }
}
