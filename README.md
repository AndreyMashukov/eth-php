# eth-php

Meta-package: a full EVM SDK for PHP. Installing this package pulls in every EVM-side primitive — Keccak, secp256k1, RLP, EIP-1559 signing, ABI encoding, and a typed Ethereum JSON-RPC client with an `ethers.js` v6-style facade.

## Bundled packages

- [`amashukov/keccak-php`](https://github.com/AndreyMashukov/keccak-php) — Keccak-256 / SHA-3
- [`amashukov/secp256k1-php`](https://github.com/AndreyMashukov/secp256k1-php) — secp256k1 EC + ECDSA + EIP-191 recover
- [`amashukov/rlp-php`](https://github.com/AndreyMashukov/rlp-php) — RLP encoder/decoder
- [`amashukov/eip1559-tx-signer-php`](https://github.com/AndreyMashukov/eip1559-tx-signer-php) — Type-2 raw-tx assembly + RFC 6979 signing
- [`amashukov/abi-encoder-php`](https://github.com/AndreyMashukov/abi-encoder-php) — Solidity ABI calldata encoder
- [`amashukov/eth-rpc-client-php`](https://github.com/AndreyMashukov/eth-rpc-client-php) — JSON-RPC client + typed VOs
- [`amashukov/http-client-php`](https://github.com/AndreyMashukov/http-client-php) — `ext-curl` HTTP foundation

## Status

Pre-1.0. Public API may change before the 1.0 tag.

## Requirements

- PHP 8.3+
- `ext-gmp`
- `ext-curl`

## License

MIT License.
