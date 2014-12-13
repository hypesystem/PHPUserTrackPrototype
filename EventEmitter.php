<?php

class EventEmitter {
    public function sendEvent($event) {
        file_put_contents("event-stream.out", $event->toJson."\n", FILE_APPEND);
    }
}

?>