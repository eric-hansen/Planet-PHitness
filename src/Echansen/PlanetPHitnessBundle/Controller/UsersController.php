<?php

namespace Echansen\PlanetPHitnessBundle\Controller;

use Echansen\PlanetPHitnessBundle\Entity\Users;
use Echansen\PlanetPHitnessBundle\Form\UsersType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Should only be used when the user has already been authenticated.
 *
 * A lot of JSON responses...a lot...
 *
 * @Route("/users")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/login", name="users.login")
     */
    public function loginAction()
    {
        $session = new Session();
        $session->start();

        return $this->render('PlanetPHitnessBundle:Users:login.html.twig', ['notices' => $session->getFlashBag()->all()]);
    }

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

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var Users $user */
            $user = $form->getData();

            // Override the passed in password to generate a salted and hashy password
            $user->setPassword($user->generateHash());

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $session = new Session();
            $session->start();

            $session->getFlashBag()->add('notice', 'Registration successful!');

            $this->redirectToRoute('users.login');
        }

        return $this->render('PlanetPHitnessBundle:Users:register.html.twig', ['form' => $form->createView()]);
    }
}
