<?php
use lem\base\ApplicationRegistry;
use lem\command\Command;
use lem\command\CommandContext;

/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 27.02.2016
 * Time: 16:53
 */
class LoginCommand extends Command
{

    function execute(CommandContext $context)
    {
        $manager = ApplicationRegistry::instance()->getAccessManager();
        $user = $context->get('user');
        $pass = $context->get('pass');
        $user_obj = $manager->login($user,$pass);

        var_dump($user_obj);
    }
}