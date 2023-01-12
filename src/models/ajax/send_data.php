<?php
class SendData {
    protected function sendData() {
        if ($this->data) {
            Logger::_echo('inside send_data.php');
            header ("Content-type: application/json");
            echo json_encode($this->data);
        }

        return false;
    }
}