<?php
declare(strict_types=1);

use API\Desafio;
use PHPUnit\Framework\TestCase;

class ApiDesafioTest extends TestCase
{
    private $json = '{"numero_casas":1,"token":"44b41ace58ea17b2dc98ead2dd34926a7aedbbd3","cifrado":"lopxmfehf jt qpxfs. gsbodjt cbdpo","decifrado":"","resumo_criptografico":""}';
    private $token = '44b41ace58ea17b2dc98ead2dd34926a7aedbbd3';

    public function testGetContentDesafio(): void
    {
        /** @var Desafio $desafio */
        $desafio = new Desafio($this->token);
        $result = $desafio->getContent();
        $this->assertJsonStringEqualsJsonString($this->json, $result);
    }

    public function testPostContentDesafio(): void
    {
        /** @var Desafio $desafio */
        $desafio = new Desafio($this->token);

        $result = $desafio->setContent();
    }
}
