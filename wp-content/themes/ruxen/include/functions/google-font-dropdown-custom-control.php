<?php

if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

 class ruxen_Google_Font_Dropdown_Custom_Control extends WP_Customize_Control
 {
    private $fonts = true;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->fonts = $this->ruxen_get_fonts();
        parent::__construct( $manager, $id, $args );
    }

    public function render_content()
    {
        if(!empty($this->fonts))
        {
            ?>
                <label>
                    <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                    <select <?php $this->link(); ?>>
                        <?php
                            foreach ( $this->fonts as $k => $v )
                            {
                                printf('<option id="%s" value="%s" %s>%s</option>', $k, $v->family, selected($this->value(), $k, false), $v->family );
                            }
                        ?>
                    </select>
                </label>
            <?php
        }
    }

    public function ruxen_get_fonts( $amount = 300 )
    {
        $selectDirectory = get_stylesheet_directory().'/include/lib/select/';
        $selectDirectoryInc = get_stylesheet_directory().'/include/lib/select/';

        $finalselectDirectory = '';

        if(is_dir($selectDirectory))
        {
            $finalselectDirectory = $selectDirectory;
        }

        if(is_dir($selectDirectoryInc))
        {
            $finalselectDirectory = $selectDirectoryInc;
        }

        $fontFile = get_stylesheet_directory() . '/include/lib/google-web-fonts.txt';

        $cachetime = 86400 * 7;

        if(file_exists($fontFile) && $cachetime < filemtime($fontFile))
        {
            $content = json_decode(file_get_contents($fontFile));
        } else {

            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key={API_KEY}';

            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );

            $fp = fopen($fontFile, 'w');
            fwrite($fp, $fontContent['body']);
            fclose($fp);

            $content = json_decode($fontContent['body']);
        }

        if($amount == 'all')
        {
            return $content->items;
        } else {
            return array_slice($content->items, 0, $amount);
        }
    }
 }
?>