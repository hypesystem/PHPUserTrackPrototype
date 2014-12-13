<?php

require_once "EventEmitter.php";
require_once "UserViewEvent.php";

class TrackCurrentUserView {
    public function __construct() {
        $this->eventEmitter = new EventEmitter();
    }
    
    public function execute() {
        $ipHash = $this->getIpHash();
        $cookieHash = $this->getCookieHash();
        $view = $this->getView();
        
        $this->eventEmitter->sendEvent(new UserViewEvent(
            $ipHash,
            $cookieHash,
            $view
        ));
        
        if($ipHash != $cookieHash) {
            $this->setUserCookieHash($ipHash);
        }
    }
    
    private function getIpHash() {
        $ip = $_SERVER["REMOTE_ADDR"];
        return hash('sha256', $ip);
    }
    
    private function getCookieHash() {
        $cookieHash = $_COOKIE["userHash"];
        if($cookieHash != "") {
            return $cookieHash;
        }
        return null;
    }
    
    private function getView() {
        $url = parse_url($_SERVER["REQUEST_URI"]);
        return $url["path"];
    }
}

?>