<?php

namespace Siqwell\Eagle\HttpClient;

class Request
{
    const METHODS = [
        'GET',
        'HEAD',
        'PUT',
        'POST',
        'PATCH',
        'DELETE'
    ];
    
    /**
     * @var string
     */
    private $path;
    
    /**
     * @var string
     */
    private $method;
    
    /**
     * @var array
     */
    private $parameters;
    
    /**
     * Request constructor.
     * @param string $path
     * @param string $method
     * @param array  $parameters
     * @throws \InvalidArgumentException
     */
    public function __construct($method = 'GET', $path = '/', array $parameters = [])
    {
        if (!in_array($method, self::METHODS)) {
            throw new \InvalidArgumentException("Unsupproted method '$method'");
        }
        
        $this->path = $path;
        $this->method = $method;
        $this->parameters = $parameters;
        
        $this->replaceVariables();
    }
    
    /**
     * Replace $params in url like {id} to it's value
     */
    public function replaceVariables()
    {
        foreach ($this->parameters as $var => $val) {
            $path = str_replace('{' . $var . '}', $val, $this->getPath());
            $this->setPath($path);
        }
    }
    
    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
    
    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }
    
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
    
    /**
     * @param string $method
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
    }
    
    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
    
    /**
     * @param array $parameters
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }
}
