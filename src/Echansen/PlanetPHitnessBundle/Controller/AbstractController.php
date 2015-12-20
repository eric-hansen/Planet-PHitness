<?php

namespace Echansen\PlanetPHitnessBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends Controller
{
    public function before()
    {

    }

    public function JsonResponse(array $content = [], $responseCode = Response::HTTP_OK)
    {
        return new JsonResponse($content, $responseCode);
    }
}