<?php

declare(strict_types=1);

namespace App\Infrastructure\Secure;

use App\Domain\Secure\DataEncryptionRepository;

class DataEncryption implements DataEncryptionRepository
{
    /**
     * @var string
     */
    private string $key;

    /**
     * @var array
     */
    private array $data;

    /**
     * @param string $key
     * @param array $data
     */
    public function __construct(string $key, array $data)
    {
        $this->key = $key;
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function encrypt(): ?string
    {
        if(!$this->data){return null;}
        $serializeStr = serialize($this->data);
        $encryptText = openssl_encrypt($serializeStr, 'AES256', $this->key, 0, $_ENV['DASH_INIT_VECTOR']);
        return base64_encode($encryptText);
    }

    /**
     * {@inheritdoc}
     */
    public function decrypt(): ?array
    {
        if(!$this->data){return null;}
        if(!isset($this->data['data'])){return null;}
        $encryptText = base64_decode($this->data['data']);
        $decryptText = openssl_decrypt($encryptText, 'AES256', $this->key, 0, $_ENV['DASH_INIT_VECTOR']);
        return unserialize($decryptText);
    }
}
