<?php

class Tag_Manager {
    private $base_url;

    public function config_loaded(&$settings)
    {
        $this->base_url = $settings['base_url'];
    }

    public function before_read_file_meta(&$headers)
    {
        $headers['tags'] = 'Tags';
    }

    public function file_meta(&$meta)
    {
        $raw = preg_replace('/\, /', ',', $meta['tags']);
        $tags = explode(',', $raw);

        $output = '';
        foreach ($tags as $tag) {
            $output .= '<a href="'.$this->base_url.'/tags/'.preg_replace('/\ /', '-', strtolower($tag)).'">'.ucfirst($tag).'</a>, ';
        }
        $output = substr($output, 0, -2);

        $meta['tags'] = $output;
    }

    public function before_render(&$twig_vars, &$twig, &$template)
    {
        // die('<pre>'.print_r($twig_vars,true).print_r($twig,true).print_r($template,true));
    }
}

?>
