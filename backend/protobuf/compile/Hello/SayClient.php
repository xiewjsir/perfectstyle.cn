<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Hello;

/**
 */
class SayClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Hello\Request $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function Hello(\Hello\Request $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/hello.Say/Hello',
        $argument,
        ['\Hello\Response', 'decode'],
        $metadata, $options);
    }

}
