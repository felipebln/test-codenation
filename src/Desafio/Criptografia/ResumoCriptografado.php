<?php
declare(strict_types=1);

namespace Desafio\Criptografia;

class ResumoCriptografado
{
    public function __construct()
    {
    }

    public function criptografarSha1(string $content): string
    {
        return sha1($content);
    }
}
