<?php
/** 
 * @author noah
 * @date 4/5/11
 * @brief
 * 
 */

defined('SYSPATH') or die('No direct script access.');

return array
(
    // Leave this alone
    'modules' => array(

        // This should be the path to this modules userguide pages, without the 'guide/'. Ex: '/guide/modulename/' would be 'modulename'
        'kacela' => array(

            // Whether this modules userguide pages should be shown
            'enabled' => TRUE,

            // The name that should show up on the userguide index page
            'name' => 'kacela',

            // A short description of this module, shown on the index page
            'description' => 'Robust DataMapper framework for PHP 5.3 and Kohana 3.x',

            // Copyright message, shown in the footer for this module
            'copyright' => '&copy; 2011 Noah Goodrich',
        )
    )
);