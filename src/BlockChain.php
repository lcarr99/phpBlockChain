<?php

namespace Carrd\PhpBlockchain;

use Carrd\PhpBlockchain\Block;

class BlockChain
{
    private array $blocks = [];

    public function __construct()
    {
        $block = new Block(rand(1, 20000), 'The Genesis Block');

        $block->setNumber(1);

        $this->addBlock($block);
    }

    public function addBlock(Block $block): void
    {
        $blockNumber = count($this->blocks) + 1;
        $block->setNumber($blockNumber);

        if ($blockNumber > 1) {
            $block->setPreviousHash($this->getBlockByNumber($blockNumber - 1)->getHash());
        }

        $this->blocks[] = $block;
    }

    public function getBlockByNumber(int $number): ?Block
    {
        foreach ($this->blocks as $block) {
            if ($block->getNumber() === $number) {
                return $block;
            }
        }

        return null;
    }

    public function validate(): bool
    {
        foreach ($this->blocks as $block) {
            if ($block->isValid()) {
                continue;
            }

            return false;
        }

        return true;
    }
}
