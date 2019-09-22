<?php
declare(strict_types=1);

use Desafio\Criptografia\ResumoCriptografado;
use PHPUnit\Framework\TestCase;


class ResumoCriptografadoTest extends TestCase
{
    public function testRetornoSha1(): void
    {
        /** @var ResumoCriptografado $resumoCriptografado */
        $resumoCriptografado = new ResumoCriptografado();
        $resultCriptografia = $resumoCriptografado->criptografarSha1('bebe');
        $this->assertEquals('b6204a75b33ab44405d3c00d38a1fd3f67ac2706', $resultCriptografia);
    }
}
