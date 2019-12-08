<?php
declare(strict_types=1);

namespace PersonDBSkeleton;

require_once __DIR__ . '/bootstrap.php';
use PersonDBSkeleton\Utils\Uuid4;

$generator = new class {
    use Uuid4;
    public function __invoke() {
        return $this->asBase64();
    }
};
print 'uuid64:' . PHP_EOL;
print $generator() . PHP_EOL;
