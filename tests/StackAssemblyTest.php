<?php

declare(strict_types=1);

namespace Amashukov\Eth\Tests;

use Amashukov\AbiEncoder\AbiEncoder;
use Amashukov\Eip1559TxSigner\Eip1559Signer;
use Amashukov\EthRpc\BlockTag;
use Amashukov\EthRpc\EthRpcClient;
use Amashukov\EthRpc\EthRpcClientInterface;
use Amashukov\EthRpc\JsonRpcProvider;
use Amashukov\EthRpc\Numeric\HexBig;
use Amashukov\EthRpc\Numeric\HexInt;
use Amashukov\EthRpc\Numeric\Wei;
use Amashukov\EthRpc\Vo\EthereumTxBundle;
use Amashukov\Keccak\Keccak;
use Amashukov\Rlp\Rlp;
use Amashukov\Secp256k1\Ecdsa;
use Amashukov\Secp256k1\Secp256k1;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class StackAssemblyTest extends TestCase
{
    /**
     * @return list<array{0: class-string}>
     */
    public static function stackClasses(): array
    {
        return [
            [Keccak::class],
            [Secp256k1::class],
            [Ecdsa::class],
            [Rlp::class],
            [Eip1559Signer::class],
            [AbiEncoder::class],
            [EthRpcClient::class],
            [EthRpcClientInterface::class],
            [JsonRpcProvider::class],
            [BlockTag::class],
            [EthereumTxBundle::class],
            [HexInt::class],
            [HexBig::class],
            [Wei::class],
        ];
    }

    #[DataProvider('stackClasses')]
    public function testEveryStackComponentAutoloads(string $class): void
    {
        self::assertTrue(class_exists($class) || interface_exists($class) || enum_exists($class), sprintf('%s is not autoloadable', $class));
    }

    public function testKeccakInteropProducesCanonicalEmptyHash(): void
    {
        self::assertSame('c5d2460186f7233c927e7db2dcc703c0e500b653ca82273b7bfad8045d85a470', Keccak::hash('', 256));
    }

    public function testAbiEncoderSelectorInteropThroughKeccak(): void
    {
        self::assertSame('0x70a08231', '0x' . AbiEncoder::methodId('balanceOf(address)'));
    }
}
