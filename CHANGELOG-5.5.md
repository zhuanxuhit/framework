# Release Notes for 5.5.x

## [Unreleased]

### General
- Require PHP 7+ ([06907a0](https://github.com/laravel/framework/pull/17048/commits/06907a055e3d28c219f6b6ab97902f0be3e8a4ef), [39809ce](https://github.com/laravel/framework/pull/17048/commits/39809cea81a5564d196c16a87cbc25de88dd3d1c))
- Removed deprecated `ServiceProvider::compile()` method ([10da428](https://github.com/laravel/framework/pull/17048/commits/10da428eb344191608474f1c12ee7edb0290e80a))
- Removed deprecated `Str::quickRandom()` method ([2ef257a](https://github.com/laravel/framework/pull/17048/commits/2ef257a4197b7e6efeb0d6ac4a3958f82b7fed39))
- Removed `build` scripts ([7c16b15](https://github.com/laravel/framework/pull/17048/commits/7c16b154ede10ff9a37756e32d7dddf317524634))
- Removed usages of the `with()` helper ([#17888](https://github.com/laravel/framework/pull/17888))

### Eloquent
- Indicate soft deleted models as existing ([#17613](https://github.com/laravel/framework/pull/17613))
- Added `$localKey` parameter to `HasRelationships::belongsToMany()` and `BelongsToMany` ([#17903](https://github.com/laravel/framework/pull/17903), [7c7c3bc](https://github.com/laravel/framework/commit/7c7c3bc4be3052afe0889fe323230dfd92f81000))
- Renamed `$parent` property to `$pivotParent` in `Pivot` class ([#17933](https://github.com/laravel/framework/pull/17933))
- Don't add `_count` suffix to column name when using `withCount()` with an alias ([#17871](https://github.com/laravel/framework/pull/17871))

### Events
- Removed calling queue method on handlers ([0360cb1](https://github.com/laravel/framework/commit/0360cb1c6b71ec89d406517b19d1508511e98fb5), [ec96979](https://github.com/laravel/framework/commit/ec969797878f2c731034455af2397110732d14c4), [d9be4bf](https://github.com/laravel/framework/commit/d9be4bfe0367a8e07eed4931bdabf135292abb1b))

### HTTP
- Ensure `Arrayable` and `Jsonable` return a `JsonResponse` ([#17875](https://github.com/laravel/framework/pull/17875))
- Ensure `Arrayable` objects are also morphed by `Response` ([#17868](https://github.com/laravel/framework/pull/17868))
- Added `SameSite` support to `CookieJar` ([#18040](https://github.com/laravel/framework/pull/18040))

### Queue
- Removed redundant `$queue` parameter from `Queue::createPayload()` ([#17948](https://github.com/laravel/framework/pull/17948))

### Redis
- Removed `PhpRedisConnection::proxyToEval()` method ([#17360](https://github.com/laravel/framework/pull/17360))

### Routing
- Bind empty optional route parameter to `null` instead of empty model instance ([#17521](https://github.com/laravel/framework/pull/17521))

### Testing
- Switched to PHPUnit 6 ([#17755](https://github.com/laravel/framework/pull/17755), [#17864](https://github.com/laravel/framework/pull/17864))
- Renamed authentication assertion methods ([#17924](https://github.com/laravel/framework/pull/17924), [494a177](https://github.com/laravel/framework/commit/494a1774f217f0cd6b4efade63e200e3ac65f201))
