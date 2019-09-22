<?php
declare(strict_types=1);

namespace API;


use GuzzleHttp\Client;

class Desafio
{
    private $url = 'https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=';
    private $urlSubmit = 'https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token=';
    private $token;


    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getContent(): string
    {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->url . $this->token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => ''
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new HttpException('cURL Error #:' . $err);
        }
        return $response;
    }

    public function postFileContent(string $file): void
    {

        $client = new Client(['base_uri' => $this->urlSubmit]);

        $response = $client->request('POST', '/v1/challenge/dev-ps/submit-solution?token=' . $this->token, [
            'multipart' => [
                [
                    'name' => 'answer',
                    'contents' => 'data',
                    'headers' => ['Content-Type: multipart/form-data']
                ],
                [
                    'name' => 'answer',
                    'contents' => fopen($file, 'r'),
                    'filename' => 'answer'
                ]
            ]
        ]);
        $responseBody = $response->getBody()->getContents();

        var_dump($responseBody);
        die('teste');
    }
}