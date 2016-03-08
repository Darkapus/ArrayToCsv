<?php
namespace Service;

class ArrayToCsv{
    private $filename='file.csv', $array, $headers, $delimiter, $enclosure, $encloseAll;

    public function __construct($array=array(), $headers=true, $delimiter = ';', $enclosure = '"', $encloseAll = false){
        $this->array        = $array;
        $this->headers      = $headers;
        $this->delimiter    = $delimiter;
        $this->enclosure    = $enclosure;
        $this->encloseAll   = $encloseAll;
    }
    public function setFilename($filename){
        $this->filename= $filename;
        return $this;
    }
    public function getHeaders(){
        return $this->enclosure.implode($this->enclosure.$this->delimiter.$this->enclosure, array_keys($this->array[0])).$this->enclosure.PHP_EOL;
    }

    public function process($array){
        $csv = array();
        foreach ($array as $val) {
            if (is_array($val)) {
                $csv[] = $this->process($val);
                $csv[] = PHP_EOL;
            } else {
                if(is_string($val) || $this->encloseAll){
                    $csv[] = $this->enclosure.$val.$this->enclosure;
                }
                else{
                    $csv[] = $val;
                }
                $csv[] = $this->delimiter;
            }
        }
        return implode('', $csv);
    }

    public function getCsvData(){
        $data = '';
        if($this->headers){
            $data .= $this->getHeaders();
        }

        $data .= $this->process($this->array);

        return $data;
    }

    public function getContentType(){
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$this->filename);
        header("Pragma: no-cache");
        header("Expires: 0");
    }

    public function download(){
        $this->getContentType();
        echo $this->getCsvData();
        return $this;
    }
}
