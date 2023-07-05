<?php 
namespace App\Helpers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class APIClient {

    /** @var array */
    protected $apiUrls = [
        'starter' => 'https://api.rajaongkir.com/starter/',
        'basic' => 'https://api.rajaongkir.com/basic/',
        'pro' => 'https://pro.rajaongkir.com/api/',
    ];

    /** @var string */
    private $apiUrl;

    /** @var array */
    private $headers = [];

    /** @var array */
    private $params;

    /**
     * @param string url
     * 
     * @return APIClient
     */
    public function setUrl($package, $endpoint): APIClient {
        $this->apiUrl = $this->apiUrls[$package] . $endpoint;

        return $this;
    }

    /**
     * @param array $headers
     * 
     * @return APIClient
     */
    public function setHeaders($headers): APIClient {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @param array $params
     * 
     * @return APIClient
     */
    public function setParams($params): APIClient {
        $this->params = $params;

        return $this;
    }

    /**
     * The function fetchData() uses cURL to make an HTTP request to an API, retrieves the response,
     * checks for errors, and returns the processed data.
     * 
     * @return mixed
     */
    public function fetchData() {
        $curl = curl_init();

        if (!empty($this->params)) {
            $this->apiUrl .= '?' . http_build_query($this->params);
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->headers
        ));
        

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new Exception("cURL error: " . $error);
        }

        curl_close($curl);
        $data = json_decode($response, true);

        // Error Handling
        if (!isset($data['rajaongkir']['status']['code']) || !isset($data['rajaongkir']['results'])) {
            throw new Exception('Error Server!');    
        }

        if ($data['rajaongkir']['status']['code'] != 200) {
            throw new Exception('Error Result: '.$data['rajaongkir']['status']['description'], $data['rajaongkir']['status']['code']);
        }

        if (count($data['rajaongkir']['results']) < 1) {
            throw new ModelNotFoundException('Data Not Found!');
        }

        return $data;
    }
}
