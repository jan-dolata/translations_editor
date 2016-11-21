<?php

return [

    /**
     * List of system languages in editor
     */
    'languages' => ['en', 'pl'],

    /**
     * Fill empty trans lines with base value
     */
    'fillEmpty' => true,

    /**
     * Use default controller, views and routes
     */
    'useDefault' => true,

    /**
     * Routes middleware
     */
    'middleware' => ['web', 'auth'],

    /**
    * Route custom parameters i.e. ['prefix' => 'example']
    */
    'route_params' => [],

    /**
     * Back button route
     */
    'backUrl' => '/',

    /**
     * Public library in head
     */
    'bootstrapCssPath' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
    'bootstrapJsPath' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
    'jqueryPath' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js'

];
