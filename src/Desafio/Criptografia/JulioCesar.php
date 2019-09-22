<?php
declare(strict_types=1);

namespace Desafio\Criptografia;


class JulioCesar
{

    private const CIFRADO = '+';
    private const DECIFRADO = '-';
    private const LIMITE = 26;
    private $vocabularyLetters;

    public function __construct()
    {
        $this->generateLetters();
    }

    /**
     * @param string $content
     * @param int $code
     * @return string
     */
    public function cifrado(string $content, int $code): string
    {
        return $this->createContent($content, $code, self::CIFRADO);
    }

    /**
     * @param string $content
     * @param int $code
     * @return string
     */
    public function decifrar(string $content, int $code): string
    {
        return $this->createContent($content, $code, self::DECIFRADO);
    }


    private function generateLetters(): void
    {
        foreach (range('a', 'z') as $letter) {
            $this->vocabularyLetters[] = $letter;
        }
    }

    /**
     * @param string $content
     * @param int $code
     * @param string $operation
     * @return string
     */
    private function createContent(string $content, int $code, string $operation): string
    {
        $contentEncrypted = '';
        $arrayContent = str_split($content);

        foreach ($arrayContent as $value) {
            $indexLetter = array_search($value, $this->vocabularyLetters, true);
            if ($indexLetter !== 0 && !$indexLetter) {
                $contentEncrypted .= $value;
                continue;
            }
            if ($operation === self::CIFRADO) {
                $index = $indexLetter + $code > self::LIMITE ? ($code + $indexLetter) - self::LIMITE : $indexLetter + $code;
            } else {
                $index = $indexLetter - $code < 0 ? ($indexLetter - $code) + self::LIMITE : $indexLetter - $code;

            }
            $contentEncrypted .= $this->vocabularyLetters[$index];
        }
        return $contentEncrypted;
    }
}
