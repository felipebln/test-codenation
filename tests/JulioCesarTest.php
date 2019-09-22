<?php
declare(strict_types=1);

use Desafio\Criptografia\JulioCesar;
use PHPUnit\Framework\TestCase;

class JulioCesarTest extends TestCase
{
    public function testCifrado(): void
    {
        /** @var JulioCesar $criptografar */
        $criptografar = new JulioCesar();
        $encripted = $criptografar->cifrado('knowledge is power. francis bacon', 1);
        $this->assertEquals('lopxmfehf jt qpxfs. gsbodjt cbdpo', $encripted);
    }

    public function testDecifrado(): void
    {
        /** @var JulioCesar $decifrar */
        $julioCesar = new JulioCesar();
        $decifrado = $julioCesar->decifrar('lopxmfehf jt qpxfs. gsbodjt cbdpo', 1);
        $this->assertEquals('knowledge is power. francis bacon', $decifrado);
    }
}