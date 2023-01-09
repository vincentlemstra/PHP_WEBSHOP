<?php
require_once "htmldoc.php";
class Form extends HtmlDoc
{
    // --- PROPERTIES --- 
    private $fieldinfo;
    private $postresult;

    // --- CONSTRUCT ---
    public function __construct(string $page, $postresult)
    {
        parent:: __construct($page);
        $this->postresult = $postresult;
    }

      // --- PROTECTED METHODS OVERRIDES ---
    protected function showMain() { 
        $this->openForm();
        $this->showFields();
        $this->closeForm();
    }

    // --- PRIVATE METHODS ---
    private function openForm() {
        if (isset($this->postresult['postError'])) {
            echo '<p><span class="error">'.$this->postresult['postError'].'</span></p>';
        }
        echo '
        <form class="standard_form" method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
            <input type="hidden" name="page" value="'.$this->page.'">';
    }

    private function showFields() {
        require_once MODELS.'site.model.php';
        $siteModel = new SiteModel();
        $this->fieldinfo = $siteModel->getFieldinfo($this->page);
        
        // show fields
        foreach ($this->fieldinfo as $fieldname => $this->fieldinfo) {
            $current_value = (isset($this->postresult[$fieldname]) ? $this->postresult[$fieldname] : '');

            if (isset($this->postresult[$fieldname.'_err'])) {
                echo '<span class="error">* '.$this->postresult[$fieldname.'_err'].'</span>';
            }	

            // set label for input
            echo '<label for="'.$fieldname.'"></label>';

            switch ($this->fieldinfo['type'])
            {
                case "textarea":
                    echo '<textarea name="'.$fieldname.'" placeholder="'.$this->fieldinfo['placeholder'].'">'.$current_value.'</textarea>';
                    break;
                
                case "password":
                    echo '<input type="'.$this->fieldinfo['type'].'"
                        name="'.$fieldname.'"
                        placeholder="'.$this->fieldinfo['placeholder'].'"/>';
                    break;

                default:	
                    echo '<input type="'.$this->fieldinfo['type'].'"
                        name="'.$fieldname.'"
                        placeholder="'.$this->fieldinfo['placeholder'].'"
                        value="' .$current_value.'" />';
                    break;
            }
        }
    }

    private function closeForm() {
        echo '   
            <button type="submit" name="submit">SEND</button>
        </form>';
    }
}