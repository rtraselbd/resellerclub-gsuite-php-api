<?php

namespace RT\ResellerClub;

use Exception;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;

/**
 * Trait Helper
 * @package RT\ResellerClub
 */
trait Helper
{
    /**
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * Authentication info needed for every request
     *
     * @var array
     */
    private $authentication = [];

    /**
     * Helper constructor.
     *
     * @param Guzzle $guzzle
     * @param array  $authentication
     */
    public function __construct(Guzzle $guzzle, array $authentication)
    {
        $this->authentication = $authentication;
        $this->guzzle = $guzzle;
    }

    /**
     * @param bool $locationNum
     */
    protected function getLocation(int $locationNum, $method)
    {
        switch ($locationNum) {
            case 1:
                $name = 'in';
                break;
            case 2:
                $name = 'se';
                break;
            case 3:
                $name = 'gbl';
                break;

            default:
                $name = 'gbl';
                break;
        }

        return $name . '/' . $method;
    }

    /**
     * @param string $method
     * @param array  $args
     * @param string $prefix
     *
     * @return Exception|array
     * @throws Exception
     */
    protected function get($method, $args = [], $prefix = '')
    {
        try {
            return $this->parse(
                $this->guzzle->get(
                    $this->api . '/' . $prefix . $method . '.json?' . preg_replace(
                        '/%5B[0-9]+%5D/simU',
                        '',
                        http_build_query(
                            array_merge($args, $this->authentication)
                        )
                    )
                )
            );
        } catch (ClientException $e) {
            return $this->parse($e->getResponse());
        } catch (ServerException $e) {
            return $this->parse($e->getResponse());
        } catch (BadResponseException $e) {
            return $this->parse($e->getResponse());
        } catch (Exception $error) {
            return $error;
        }
    }


    /**
     * @param string $method
     * @param array  $args
     * @param string $prefix
     *
     * @return Exception|array
     * @throws Exception
     */
    protected function post($method, $args = [], $prefix = '')
    {
        //Todo use middleware to merge default values in guzzle
        //Merge default args with sent one
        $args = array_merge($args, $this->authentication);

        try {
            return $this->parse(
                $this->guzzle->request(
                    'POST',
                    $this->api . '/' . $prefix . $method . '.json',
                    [
                        RequestOptions::FORM_PARAMS => $args,
                    ]
                )
            );
        } catch (ClientException $e) {
            return $this->parse($e->getResponse());
        } catch (ServerException $e) {
            return $this->parse($e->getResponse());
        } catch (BadResponseException $e) {
            return $this->parse($e->getResponse());
        } catch (Exception $error) {
            return $error;
        }
    }
}
