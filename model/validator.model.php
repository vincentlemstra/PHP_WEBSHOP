<?php
class Validator {
    // --- PROPERTIES ---
    private $postresult;

    // --- PUBLIC METHODS ---
    public function checkFields() {
        require_once "site.model.php";
        $siteModel = new SiteModel();
        $fieldinfo = $siteModel->getFieldinfo($_POST['page']);

        $this->postresult['error'] = false;

        foreach ($fieldinfo as $name => $info) {
            if ($this->checkField($name, $info) === false) {	
                $this->postresult['error'] = true;
            }	
        }

        return $this->postresult;
    }

    // --- PRIVATE METHODS ---
    private function checkField(string $fieldname, array $fieldinfo) {
        $result = false;
        
        if (isset($_POST[$fieldname])) {
            $value = $_POST[$fieldname];
            $value = trim($value); 
            $value = stripslashes($value); 
            $value = htmlspecialchars($value); 

            if (empty($value)) {
                $this->postresult[$fieldname.'_err'] = $fieldinfo['label'].' is required.';
            } else {
                $result = true;
                $this->postresult[$fieldname] = $value;	
            }
        } else {
            $this->postresult[$fieldname.'_err'] = $fieldname.' not found';
        }

        return $result;
    }
}

