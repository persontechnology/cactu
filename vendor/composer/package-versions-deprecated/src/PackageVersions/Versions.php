<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/laravel';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'bacon/bacon-qr-code' => '1.0.3@5a91b62b9d37cee635bbf8d553f4546057250bee',
  'barryvdh/laravel-snappy' => 'v0.4.8@1903ab84171072b6bff8d98eb58d38b2c9aaf645',
  'brick/math' => '0.9.3@ca57d18f028f84f777b2168cd1911b0dee2343ae',
  'composer/package-versions-deprecated' => '1.11.99.4@b174585d1fe49ceed21928a945138948cb394600',
  'diglactic/laravel-breadcrumbs' => 'v7.0.1@0a14e8785fa9423c878edd3975af2a92dfcdaf42',
  'doctrine/inflector' => '2.0.4@8b7ff3e4b7de6b2c84da85637b59fd2880ecaa89',
  'doctrine/lexer' => '1.2.2@9c50f840f257bbb941e6f4a0e94ccf5db5c3f76c',
  'dragonmantank/cron-expression' => 'v2.3.1@65b2d8ee1f10915efb3b55597da3404f096acba2',
  'egulias/email-validator' => '2.1.25@0dbf5d78455d4d6a41d186da50adc1122ec066f4',
  'ezyang/htmlpurifier' => 'v4.14.0@12ab42bd6e742c70c0a52f7b82477fcd44e64b75',
  'facade/ignition-contracts' => '1.0.2@3c921a1cdba35b68a7f0ccffc6dffc1995b18267',
  'fideloper/proxy' => '4.4.1@c073b2bd04d1c90e04dc1b787662b558dd65ade0',
  'guzzlehttp/guzzle' => '7.4.1@ee0a041b1760e6a53d2a39c8c34115adc2af2c79',
  'guzzlehttp/promises' => '1.5.1@fe752aedc9fd8fcca3fe7ad05d419d32998a06da',
  'guzzlehttp/psr7' => '2.1.0@089edd38f5b8abba6cb01567c2a8aaa47cec4c72',
  'h4cc/wkhtmltoimage-amd64' => '0.12.4@c4e33f635207af89a704205b8902fb5715ca88be',
  'h4cc/wkhtmltopdf-amd64' => '0.12.4@4e2ab2d032a5d7fbe2a741de8b10b8989523c95b',
  'intervention/image' => '2.7.1@744ebba495319501b873a4e48787759c72e3fb8c',
  'knplabs/knp-snappy' => 'v1.4.1@5126fb5b335ec929a226314d40cd8dad497c3d67',
  'laminas/laminas-diactoros' => '2.8.0@0c26ef1d95b6d7e6e3943a243ba3dc0797227199',
  'laravel/framework' => 'v7.30.6@ecdafad1dda3c790af186a6d18479ea4757ef9ee',
  'laravel/sanctum' => 'v2.13.0@b4c07d0014b78430a3c827064217f811f0708eaa',
  'laravel/tinker' => 'v2.6.3@a9ddee4761ec8453c584e393b393caff189a3e42',
  'laravel/ui' => 'v2.5.0@d01a705763c243b07be795e9d1bb47f89260f73d',
  'laravelcollective/html' => 'v6.2.1@ae15b9c4bf918ec3a78f092b8555551dd693fde3',
  'laraveles/spanish' => '1.5.0@2224e3db7ec399952523b0769a7677de0b6afd8b',
  'lcobucci/clock' => '2.0.0@353d83fe2e6ae95745b16b3d911813df6a05bfb3',
  'lcobucci/jwt' => '4.1.5@fe2d89f2eaa7087af4aa166c6f480ef04e000582',
  'league/commonmark' => '1.6.6@c4228d11e30d7493c6836d20872f9582d8ba6dcf',
  'league/flysystem' => '1.1.9@094defdb4a7001845300334e7c1ee2335925ef99',
  'league/fractal' => '0.19.2@06dc15f6ba38f2dde2f919d3095d13b571190a7c',
  'league/mime-type-detection' => '1.9.0@aa70e813a6ad3d1558fc927863d47309b4c23e69',
  'maatwebsite/excel' => '3.1.35@6f171c8b79e1c0fb254f3ec40f7a11ac79289eaa',
  'maennchen/zipstream-php' => '2.1.0@c4c5803cc1f93df3d2448478ef79394a5981cc58',
  'markbaker/complex' => '3.0.1@ab8bc271e404909db09ff2d5ffa1e538085c0f22',
  'markbaker/matrix' => '3.0.0@c66aefcafb4f6c269510e9ac46b82619a904c576',
  'monolog/monolog' => '2.3.5@fd4380d6fc37626e2f799f29d91195040137eba9',
  'myclabs/php-enum' => '1.8.3@b942d263c641ddb5190929ff840c68f78713e937',
  'nesbot/carbon' => '2.55.2@8c2a18ce3e67c34efc1b29f64fe61304368259a2',
  'nikic/php-parser' => 'v4.13.2@210577fe3cf7badcc5814d99455df46564f3c077',
  'opis/closure' => '3.6.2@06e2ebd25f2869e54a306dda991f7db58066f7f6',
  'phpoffice/phpspreadsheet' => '1.21.0@1a359d2ccbb89c05f5dffb32711a95f4afc67964',
  'phpoption/phpoption' => '1.8.1@eab7a0df01fe2344d172bff4cd6dbd3f8b84ad15',
  'psr/container' => '1.1.2@513e0666f7216c7459170d56df27dfcefe1689ea',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.10.12@a0d9981aa07ecfcbea28e4bfa868031cca121e7d',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/collection' => '1.2.2@cccc74ee5e328031b15640b51056ee8d3bb66c0a',
  'ramsey/uuid' => '4.2.3@fc9bb7fb5388691fd7373cd44dcb4d63bbcf24df',
  'simplesoftwareio/simple-qrcode' => '2.0.0@90b2282dd29be1e52565e9832dc23af41610ea07',
  'spatie/laravel-permission' => '3.18.0@1c51a5fa12131565fe3860705163e53d7a26258a',
  'swiftmailer/swiftmailer' => 'v6.3.0@8a5d5072dca8f48460fce2f4131fcc495eec654c',
  'symfony/console' => 'v5.4.2@a2c6b7ced2eb7799a35375fb9022519282b5405e',
  'symfony/css-selector' => 'v5.4.2@cfcbee910e159df402603502fe387e8b677c22fd',
  'symfony/deprecation-contracts' => 'v2.5.0@6f981ee24cf69ee7ce9736146d1c57c2780598a8',
  'symfony/error-handler' => 'v5.4.2@e0c0dd0f9d4120a20158fc9aec2367d07d38bc56',
  'symfony/event-dispatcher' => 'v5.4.0@27d39ae126352b9fa3be5e196ccf4617897be3eb',
  'symfony/event-dispatcher-contracts' => 'v2.5.0@66bea3b09be61613cd3b4043a65a8ec48cfa6d2a',
  'symfony/finder' => 'v5.4.2@e77046c252be48c48a40816187ed527703c8f76c',
  'symfony/http-foundation' => 'v5.4.2@ce952af52877eaf3eab5d0c08cc0ea865ed37313',
  'symfony/http-kernel' => 'v5.4.2@35b7e9868953e0d1df84320bb063543369e43ef5',
  'symfony/mime' => 'v5.4.2@1bfd938cf9562822c05c4d00e8f92134d3c8e42d',
  'symfony/polyfill-ctype' => 'v1.24.0@30885182c981ab175d4d034db0f6f469898070ab',
  'symfony/polyfill-iconv' => 'v1.24.0@f1aed619e28cb077fc83fac8c4c0383578356e40',
  'symfony/polyfill-intl-grapheme' => 'v1.24.0@81b86b50cf841a64252b439e738e97f4a34e2783',
  'symfony/polyfill-intl-idn' => 'v1.24.0@749045c69efb97c70d25d7463abba812e91f3a44',
  'symfony/polyfill-intl-normalizer' => 'v1.24.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.24.0@0abb51d2f102e00a4eefcf46ba7fec406d245825',
  'symfony/polyfill-php72' => 'v1.24.0@9a142215a36a3888e30d0a9eeea9766764e96976',
  'symfony/polyfill-php73' => 'v1.24.0@cc5db0e22b3cb4111010e48785a97f670b350ca5',
  'symfony/polyfill-php80' => 'v1.24.0@57b712b08eddb97c762a8caa32c84e037892d2e9',
  'symfony/polyfill-php81' => 'v1.24.0@5de4ba2d41b15f9bd0e19b2ab9674135813ec98f',
  'symfony/process' => 'v5.4.2@2b3ba8722c4aaf3e88011be5e7f48710088fb5e4',
  'symfony/routing' => 'v5.4.0@9eeae93c32ca86746e5d38f3679e9569981038b1',
  'symfony/service-contracts' => 'v2.5.0@1ab11b933cd6bc5464b08e81e2c5b07dec58b0fc',
  'symfony/string' => 'v5.4.2@e6a5d5ecf6589c5247d18e0e74e30b11dfd51a3d',
  'symfony/translation' => 'v5.4.2@ff8bb2107b6a549dc3c5dd9c498dcc82c9c098ca',
  'symfony/translation-contracts' => 'v2.5.0@d28150f0f44ce854e942b671fc2620a98aae1b1e',
  'symfony/var-dumper' => 'v5.4.2@1b56c32c3679002b3a42384a580e16e2600f41c1',
  'tavo1987/ec-validador-cedula-ruc' => 'v1.0.2@379b50bc5dfda20d935df2bdd3c0de94e4fc024e',
  'tavo1987/laravel-ec-validator' => 'v2.0.0@4d6d7dd4af2df6a3b51f9e192ef530934edd8e45',
  'tijsverkoyen/css-to-inline-styles' => '2.2.4@da444caae6aca7a19c0c140f68c6182e337d5b1c',
  'vlucas/phpdotenv' => 'v4.2.2@77e974614d2ead521f18069dccc571696f52b8dc',
  'voku/portable-ascii' => '1.5.6@80953678b19901e5165c56752d087fc11526017c',
  'vonage/client' => '2.4.0@29f23e317d658ec1c3e55cf778992353492741d7',
  'vonage/client-core' => '2.10.0@abd4047c0944416d497884f4c3c8db7a52876198',
  'vonage/nexmo-bridge' => '0.1.0@62653b1165f4401580ca8d2b859f59c968de3711',
  'yajra/laravel-datatables' => 'v1.5.0@50de5e20ef01da1a353e0a81c0ad5f9da6a985ec',
  'yajra/laravel-datatables-buttons' => 'v4.13.3@5c8fb97c26c14408c8933f68d86c6e4823d05740',
  'yajra/laravel-datatables-editor' => 'v1.25.0@096282402265a7a3aad06ce88df33d13968a3a5f',
  'yajra/laravel-datatables-fractal' => 'v1.6.0@0aa387a9b3738248fa61110f0378904ef42b4a73',
  'yajra/laravel-datatables-html' => 'v4.41.0@9e5d9edf397a7311751d09377a93b47aafe7e77b',
  'yajra/laravel-datatables-oracle' => 'v9.18.2@f4eebc1dc2b067058dfb91e7c067de862353c40f',
  'beyondcode/laravel-dump-server' => '1.7.0@e27c7b942ab62f6ac7168359393d328ec5215b89',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'filp/whoops' => '2.14.5@a63e5e8f26ebbebf8ed3c5c691637325512eb0dc',
  'fzaninotto/faker' => 'v1.9.2@848d8125239d7dbf8ab25cb7f054f1a630e68c2e',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'mockery/mockery' => '1.4.4@e01123a0e847d52d186c5eb4b9bf58b0c6d00346',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'nunomaduro/collision' => 'v4.3.0@7c125dc2463f3e144ddc7e05e63077109508c94e',
  'phar-io/manifest' => '2.0.3@97803eca37d319dfa7826cc2437fc020857acb53',
  'phar-io/version' => '3.1.0@bae7c545bef187884426f042434e561ab1ddb182',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.3.0@622548b623e81ca6d78b721c5e029f4ce664f170',
  'phpdocumentor/type-resolver' => '1.6.0@93ebd0014cab80c4ea9f5e297ea48672f1b87706',
  'phpspec/prophecy' => 'v1.15.0@bbcd7380b0ebf3961ee21409db7b38bc31d69a13',
  'phpunit/php-code-coverage' => '7.0.15@819f92bba8b001d4363065928088de22f25a3a48',
  'phpunit/php-file-iterator' => '2.0.5@42c5ba5220e6904cbfe8b1a1bda7c0cfdc8c12f5',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.3@2454ae1765516d20c4ffe103d85a58a9a3bd5662',
  'phpunit/php-token-stream' => '4.0.4@a853a0e183b9db7eed023d7933a858fa1c8d25a3',
  'phpunit/phpunit' => '8.5.22@ddd05b9d844260353895a3b950a9258126c11503',
  'sebastian/code-unit-reverse-lookup' => '1.0.2@1de8cd5c010cb153fcd68b8d0f64606f523f7619',
  'sebastian/comparator' => '3.0.3@1071dfcef776a57013124ff35e1fc41ccd294758',
  'sebastian/diff' => '3.0.3@14f72dd46eaf2f2293cbe79c93cc0bc43161a211',
  'sebastian/environment' => '4.2.4@d47bbbad83711771f167c72d4e3f25f7fcc1f8b0',
  'sebastian/exporter' => '3.1.4@0c32ea2e40dbf59de29f3b49bf375176ce7dd8db',
  'sebastian/global-state' => '3.0.1@474fb9edb7ab891665d3bfc6317f42a0a150454b',
  'sebastian/object-enumerator' => '3.0.4@e67f6d32ebd0c749cf9d1dbd9f226c727043cdf2',
  'sebastian/object-reflector' => '1.1.2@9b8772b9cbd456ab45d4a598d2dd1a1bced6363d',
  'sebastian/recursion-context' => '3.0.1@367dcba38d6e1977be014dc4b22f47a484dac7fb',
  'sebastian/resource-operations' => '2.0.2@31d35ca87926450c44eae7e2611d45a7a65ea8b3',
  'sebastian/type' => '1.1.4@0150cfbc4495ed2df3872fb31b26781e4e077eb4',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'webmozart/assert' => '1.10.0@6964c76c7804814a842473e0c8fd15bab0f18e25',
  'laravel/laravel' => '1.0.0+no-version-set@',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}