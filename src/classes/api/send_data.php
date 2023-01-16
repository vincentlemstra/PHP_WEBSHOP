<?php
class SendData {
    // --- PROPERTIES ---
    protected $data;
    
    // --- CONSTRUCT ---
    public function __construct($data) {
        $this->data = $data;
    }

    // --- OVERRIDES ---
    public function sendData() {
        $type = $_GET['type'];
        switch($type) {
            case "json":
                header ("Content-type: application/json");
                echo json_encode($this->data);
                break;
            case "xml":
                break;
            case "html":
                break;
            default:
                echo "<h1>No action defined for [".$type."]</h1>";
                break;
        }

    }
}