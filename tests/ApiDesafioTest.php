<?php
declare(strict_types=1);

use API\Desafio;
use Desafio\Criptografia\JulioCesar;
use Desafio\Criptografia\ResumoCriptografado;
use Desafio\Download\Json;
use PHPUnit\Framework\TestCase;

class ApiDesafioTest extends TestCase
{
    private $json = '{"numero_casas":1,"token":"","cifrado":"lopxmfehf jt qpxfs. gsbodjt cbdpo","decifrado":"","resumo_criptografico":""}';
    private $token = '';
    /** @var Desafio $desafio */
    private $desafio;
    /** @var JulioCesar $julioCesar */
    private $julioCesar;
    /** @var ResumoCriptografado $resumoCriptografado */
    private $resumoCriptografado;
    /** @var Json $jsonFile */
    private $jsonFile;


    /**
     * ApiDesafioTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->desafio = new Desafio($this->token);
        $this->julioCesar = new JulioCesar();
        $this->resumoCriptografado = new ResumoCriptografado();
        $this->jsonFile = new Json();
    }

    public function testGetContentDesafio(): void
    {
        $result = $this->getDesafio();
        $this->assertJsonStringEqualsJsonString($this->json, $result);
    }

    public function testPostContentDesafio(): void
    {
        $valuesDesafio = json_decode($this->getDesafio(), true);
        $dir = __DIR__ . '/../public/files/';

        $valuesDesafio['decifrado'] = $this->julioCesar
            ->decifrar($valuesDesafio['cifrado'], $valuesDesafio['numero_casas']);
        $valuesDesafio['resumo_criptografico'] = $this->resumoCriptografado
            ->criptografarSha1($valuesDesafio['decifrado']);

        $jsonDesafioResolvido = json_encode($valuesDesafio);

        $fileJsonSave = $this->jsonFile->save($jsonDesafioResolvido, $dir);


        $result = $this->desafio->postFileContent($fileJsonSave);
    }

    /**
     * @return string
     */
    private function getDesafio(): string
    {
        /** @var Desafio $desafio */
        $desafio = new Desafio($this->token);
        $result = $desafio->getContent();
        return $result;
    }
}
