<?php
namespace lem\command;
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 27.02.2016
 * Time: 16:48
 */
abstract class Command
{
    abstract function execute(CommandContext $context);
}