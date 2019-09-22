<?php
declare(strict_types=1);

namespace Desafio\Download;


class Json
{

    public function __construct()
    {
    }

    public function save(string $data, string $directory): string
    {
        $name = date('Ymdhis') . '.json';
        file_put_contents($directory . $name, $data);
        return $directory . $name;
    }
}