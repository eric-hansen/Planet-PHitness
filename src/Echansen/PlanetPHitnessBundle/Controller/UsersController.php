<?php

namespace Echansen\PlanetPHitnessBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Should only be used when the user has already been authenticated.
 *
 * A lot of JSON responses...a lot...
 *
 * @Route("/users")
 */
class UsersController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('PlanetPHitnessBundle:Default:index.html.twig');
    }

    public function weightsDataAction()
    {

    }

    public function machineSettingsAction()
    {

    }

    /**
     * Returns a user's salt.
     *
     * @Route("/salt", name="users.salt")
     */
    public function saltAction()
    {
        // @TODO: replace findOneById(1) with the proper user ID/PK (get via session)

        /** @var Users $userInfo */
        $userInfo = $this->get('doctrine.orm.default_entity_manager')->getRepository('PlanetPHitnessBundle:Users')->findOneById(1);

        return new JsonResponse(array('salt' => $userInfo->getSalt()));
    }

    public function cardioSettingsAction()
    {

    }

    /**
     * Destroys the user's session and returns 200 on success.
     */
    public function logoutAction()
    {

    }
}
