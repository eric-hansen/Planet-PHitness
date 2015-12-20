<?php

namespace Echansen\PlanetPHitnessBundle\Controller;

use Echansen\PlanetPHitnessBundle\Entity\Users;
use Echansen\PlanetPHitnessBundle\Form\UsersType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/salt/{id}", name="users.salt", requirements={"id" = "\d+"})
     */
    public function saltAction($id)
    {
        // @TODO: replace findOneById(1) with the proper user ID/PK (get via session)

        /** @var Users $userInfo */
        $userInfo = $this->get('doctrine.orm.default_entity_manager')->getRepository('PlanetPHitnessBundle:Users')->findOneById($id);

        return $this->JsonResponse(['salt' => $userInfo->getSalt()]);
    }

    public function cardioSettingsAction()
    {

    }

    /**
     * @Route("/register", name="users.register")
     */
    public function registerAction(Request $request)
    {
        $task = new Users();
        $form = $this->createForm(UsersType::class, $task);

        // $salt = \mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);

        return $this->render('PlanetPHitnessBundle:Users:register.html.twig', ['form' => $form->createView()]);
    }
}
