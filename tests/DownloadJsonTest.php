<?php
declare(strict_types=1);

use Desafio\Download\Json;
use PHPUnit\Framework\TestCase;


class DownloadJsonTest extends TestCase
{

    public function testDownladJsonToFolder(): void
    {
        $json = '{"numero_casas":1,"token":"","cifrado":"lopxmfehf jt qpxfs. gsbodjt cbdpo","decifrado":"","resumo_criptografico":""}';
        $name = 'content.json';
        $dir = __DIR__ . '/../public/files/';

        file_put_contents($dir . $name, $json);
        /** @var Json $downloadJson */
        $downloadJson = new Json();

        $result = $downloadJson->save($json, $dir);
        $this->assertFileEquals($result, $dir . $name, $json);
    }
}
