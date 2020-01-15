<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class DefaultController.
 */
class DefaultController extends AbstractController
{
    public function index()
    {
        return $this->render('default/index.twig');
    }
}
