<?php

class Settings {

    private $config;

    protected function __construct() {
        $this->config = array();
    }

    public function Add($attributes, $value = '') {
        if (!is_array($this->config)) {
            $this->config = $this->config[$attributes][$value];
        } else {
            $this->config = array_merge($this->config, $attributes);
        }
    }

    public function Value($val = '') {
        if ($val === '') {
            return $this->config;
        } elseif ($val !== '') {
            return $this->config[$val];
        }
    }

    public function XML() {
        foreach ($this->config as $key => $value) {
            $this->xml .= '<' . $key . '>';
            if (is_array($value)) {
                foreach ($value as $key2 => $value2) {
                    $this->xml .= '<' . $key2 . '>';
                    $this->xml .= '<' . $value2 . '/>';
                    $this->xml .= '</' . $key2 . '>';
                }
            } else {
                $this->xml .= '<' . $value . '/>';
            }
            $this->xml .= '</' . $key . '>';
        }
    }

}

?>
