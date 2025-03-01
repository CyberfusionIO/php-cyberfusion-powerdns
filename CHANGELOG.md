# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/). 

## [2.5.0]

### Added

- Add support for Laravel 12.

## [2.4.0]

### Changed

- Ensure RRSet serialization is consistent with the API.
- Update version in the client, which hasn't been done for a while.

## [2.3.0]

### Added

- Add Laravel 11 support.

## [2.2.0]

### Added

- Add DNS key algorithm getter to the `CryptoKey` model.

## [2.1.0]

### Added

- Add public key and protocol getters, and flags getter/setter the `CryptoKey` model.

### Changed

- Allow the `zone`, `catalog` and `account` to be null for the `Zone` model.

## [2.0.3]

### Fixed

- When retrieving the CryptoKey, except a single result instead of a list.

## [2.0.2]

### Fixed

- Limit the size of the account name to 40 characters for the `Comment` model.

## [2.0.1]

### Fixed

- Ensure the name of the RRSet ends with the required dot.

## [2.0.0]

### Added

- Add the ability to provide your own HTTP client for additional configuration.

## [1.2.0]

### Changed

- Improve CI.

## [1.1.0]

### Added

- Add Laravel 10 support.

## [1.0.0]

### Added

- Initial release.