<?php

require_once('IyzipayBootstrap.php');

IyzipayBootstrap::init();

class Config
{
    public static function options()
    {
        $options = new \Iyzipay\Options();
<<<<<<< Updated upstream
        $options->setApiKey('ApiKey');
        $options->setSecretKey('SecretKey');
=======
<<<<<<< HEAD
        
=======
        $options->setApiKey('sandbox-OInnUVaq5h7rS306Ifa1OTgYdC1bOqyk');
        $options->setSecretKey('sandbox-JXNnEcyPyqYob8VzL67YhrOIJcPXyjdg');
>>>>>>> 3ad5d42700030e0cd319768fc7a2a0a9798454bf
>>>>>>> Stashed changes
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');

        return $options;
    }
<<<<<<< Updated upstream
}
=======
}
>>>>>>> Stashed changes
