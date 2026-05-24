# amashukov/eth-php

Pure-PHP Ethereum / EVM SDK — Keccak-256, secp256k1 ECDSA, RLP, EIP-1559 offline signing, ABI encoder, and an ethers.js-style JSON-RPC client in one `composer require`.

[![CI](https://img.shields.io/github/actions/workflow/status/AndreyMashukov/eth-php/ci.yml?branch=main&label=CI)](https://github.com/AndreyMashukov/eth-php/actions)
[![PHPStan L9](https://img.shields.io/github/actions/workflow/status/AndreyMashukov/eth-php/stan.yml?branch=main&label=PHPStan%20L9)](https://github.com/AndreyMashukov/eth-php/actions)
[![Latest Version](https://img.shields.io/packagist/v/amashukov/eth-php)](https://packagist.org/packages/amashukov/eth-php)
[![Downloads](https://img.shields.io/packagist/dt/amashukov/eth-php)](https://packagist.org/packages/amashukov/eth-php)
[![PHP](https://img.shields.io/packagist/dependency-v/amashukov/eth-php/php)](https://packagist.org/packages/amashukov/eth-php)
[![License](https://img.shields.io/packagist/l/amashukov/eth-php)](LICENSE)
[![Stars](https://img.shields.io/github/stars/AndreyMashukov/eth-php?style=social)](https://github.com/AndreyMashukov/eth-php)

`amashukov/eth-php` is a standalone **Ethereum / EVM SDK for PHP** — a single umbrella package that pulls every EVM-side primitive you need: Keccak-256 / SHA-3 hashing, secp256k1 EC arithmetic with RFC-6979 low-S ECDSA, RLP encoding, EIP-1559 (Type-2) offline transaction signing, a Solidity ABI calldata encoder, and an ethers.js v6-style JSON-RPC client. Pure PHP, zero blockchain-library dependencies, no Symfony. It is the first maintained **ethers.js-style PHP SDK with full EIP-1559 support**.

## Features

- **Keccak-256 / SHA-3** — the hashing primitive every EVM selector and address derives from.
- **secp256k1 + ECDSA** — EC point arithmetic plus RFC-6979 deterministic, low-S signatures.
- **RLP** — recursive-length-prefix encoder / decoder for transactions and structures.
- **EIP-1559 offline signing** — assemble and sign Type-2 raw transactions without a node.
- **ABI calldata encoder** — Solidity ABI encoding that matches ethers.js byte-for-byte.
- **ethers.js-style RPC client** — JSON-RPC v6-style client with typed value objects over any PSR-18 transport.
- **One install** — the full EVM stack ships through a single `composer require`.

## Why amashukov/eth-php

`web3p/web3.php` is the historical PHP EVM client (~600★), but it is effectively abandoned and has **no EIP-1559 (Type-2) support** — it can only build legacy transactions, which most modern chains and tooling have moved past. `amashukov/eth-php` is the **first maintained ethers.js-style PHP SDK with EIP-1559**: deterministic low-S signing, an ABI encoder that matches ethers.js byte-for-byte, and a v6-style typed RPC client — each layer separately versioned, the whole stack behind **one** `composer require`.

## Installation

```bash
composer require amashukov/eth-php
```

## Usage

Each layer keeps its own namespace; import what you need:

```php
use Amashukov\Keccak\Keccak;
use Amashukov\AbiEncoder\AbiEncoder;
use Amashukov\Eip1559TxSigner\Eip1559Signer;
use Amashukov\EthRpc\EthRpcClient;
use Amashukov\EthRpc\JsonRpcProvider;

// Hash, encode calldata, sign a Type-2 tx, and broadcast it — see each
// sub-package README for the full API.
```

The layers compose: the RPC client's `getErc20Balance()` builds its calldata through the ABI encoder, which derives selectors through Keccak — one consistent stack, no duplicated crypto.

## Requirements

- PHP 8.3+
- `ext-gmp` (bigint EC + wei math)
- `ext-bcmath`
- A PSR-18 HTTP client + PSR-17 factories for the RPC client (e.g. [`amashukov/http-client-php`](https://github.com/AndreyMashukov/http-client-php) + [`nyholm/psr7`](https://github.com/Nyholm/psr7))

## Related packages

| Package | Layer |
|---------|-------|
| [amashukov/keccak-php](https://github.com/AndreyMashukov/keccak-php) | Keccak-256 / SHA-3 |
| [amashukov/secp256k1-php](https://github.com/AndreyMashukov/secp256k1-php) | secp256k1 EC arithmetic + ECDSA (RFC 6979, low-S) |
| [amashukov/rlp-php](https://github.com/AndreyMashukov/rlp-php) | RLP encoder / decoder |
| [amashukov/eip1559-tx-signer-php](https://github.com/AndreyMashukov/eip1559-tx-signer-php) | EIP-1559 (Type-2) offline raw-tx assembly + signing |
| [amashukov/abi-encoder-php](https://github.com/AndreyMashukov/abi-encoder-php) | Solidity ABI calldata encoder (ethers.js-exact) |
| [amashukov/eth-rpc-client-php](https://github.com/AndreyMashukov/eth-rpc-client-php) | ethers.js v6-style JSON-RPC client + typed VOs over PSR-18 |
| [amashukov/http-client-php](https://github.com/AndreyMashukov/http-client-php) | PSR-18 cURL HTTP client |
| [amashukov/ton-php](https://github.com/AndreyMashukov/ton-php) | Sister umbrella SDK for TON (The Open Network) |
| [amashukov/blockchain-context-bundle](https://github.com/AndreyMashukov/blockchain-context-bundle) | Symfony 7 bundle wiring the TON + EVM stacks |

## Quality

- **PHPStan level 9** across the whole stack.
- **php-cs-fixer** with the `@PER-CS` ruleset.
- **GitHub Actions CI** on every push.
- **Parity tests** pin the ABI encoder and signed transactions byte-for-byte against ethers.js.

## License

MIT — see [LICENSE](LICENSE). Each bundled package is MIT-licensed in its own repository.
