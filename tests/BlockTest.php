<?php

namespace Carrd\PhpBlockchain\Tests;

use Carrd\PhpBlockchain\Block;
use PHPUnit\Framework\TestCase;

class BlockTest extends TestCase
{
    protected Block $block;

    protected function setUp(): void
    {
        $nonce = rand(1, 2000);
        $data = json_encode([
            'name' => 'Test',
            'age' => '22',
            'dob' => '1970-08-04',
                            ]);

        $this->block = new Block($nonce, $data);
    }

    public function testUnchangedBlockIsValid(): void
    {
        $this->assertTrue($this->block->isValid());
    }

    public function testChangedBlockIsInvalid(): void
    {
        $newData = json_encode([
            'name' => 'Another Test',
            'age' => '30',
            'dob' => '1966-04-24'
                               ]);

        $this->block->setData($newData);

        $this->assertFalse($this->block->isValid());
    }


}
