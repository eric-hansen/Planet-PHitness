<?php

namespace Echansen\PlanetPHitnessBundle\Controller;

use Echansen\PlanetPHitnessBundle\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * @Route("/auth")
 */
class AuthenticationController extends AbstractController
{
    /**
     * @param Request $request
     *
     * @Route("/login")
     * @return JsonResponse
     * @throws HttpException
     */
    public function loginAction(Request $request)
    {
        $user = $request->request->get('user', '');
        $pass = $request->request->get('pass', '');

        if (!$user || !$pass)
        {
            throw new HttpException(Response::HTTP_FORBIDDEN, "Invalid username or password.");
        }

        /** @var Users $userEntity */
        $userEntity = $this->get('doctrine.orm.default_entity_manager')->getRepository('PlanetPHitness:User')->findOneByEmail($user);

        if (!$userEntity)
        {
            throw new HttpException(Response::HTTP_FORBIDDEN, "Unable to find user.");
        }

        $salt = $userEntity->getSalt();

        $pwHash = password_hash($pass, PASSWORD_BCRYPT, ['salt' => $salt, 'cost' => 12]);

        if ($pwHash !== $userEntity->getPassword())
        {
            throw new HttpException(Response::HTTP_FORBIDDEN, "Unable to authenticate.");
        }

        $userEntity->setLastLogin(new \DateTime());

        $this->get('doctrine.orm.default_entity_manager')->persist($userEntity);
        $this->get('doctrine.orm.default_entity_manager')->flush($userEntity);

        return $this->JsonResponse(['id' => $userEntity->getId(), 'salt' => $userEntity->getSalt()]);
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {

    }
}