# eth-php

A standalone Ethereum / EVM SDK for PHP — pure PHP, zero blockchain-library
dependencies. This is an umbrella package: installing it pulls every EVM-side
primitive in one `composer require`.

## What you get

| Package | Layer |
|---------|-------|
| [`amashukov/keccak-php`](https://github.com/AndreyMashukov/keccak-php) | Keccak-256 / SHA-3 |
| [`amashukov/secp256k1-php`](https://github.com/AndreyMashukov/secp256k1-php) | secp256k1 EC arithmetic + ECDSA (RFC 6979, low-S) |
| [`amashukov/rlp-php`](https://github.com/AndreyMashukov/rlp-php) | RLP encoder / decoder |
| [`amashukov/eip1559-tx-signer-php`](https://github.com/AndreyMashukov/eip1559-tx-signer-php) | EIP-1559 (Type-2) offline raw-tx assembly + signing |
| [`amashukov/abi-encoder-php`](https://github.com/AndreyMashukov/abi-encoder-php) | Solidity ABI calldata encoder (ethers.js-exact) |
| [`amashukov/eth-rpc-client-php`](https://github.com/AndreyMashukov/eth-rpc-client-php) | ethers.js v6-style JSON-RPC client + typed VOs over PSR-18 |

The layers compose: the RPC client's `getErc20Balance()` builds its calldata
through the ABI encoder, which derives selectors through Keccak — one
consistent stack, no duplicated crypto.

## Requirements

- PHP 8.3+
- `ext-gmp` (bigint EC + wei math)
- `ext-bcmath`
- A PSR-18 HTTP client + PSR-17 factories for the RPC client (e.g.
  [`amashukov/http-client-php`](https://github.com/AndreyMashukov/http-client-php) + [`nyholm/psr7`](https://github.com/Nyholm/psr7))

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

## License

MIT — see [LICENSE](LICENSE). Each bundled package is MIT-licensed in its own
repository.
