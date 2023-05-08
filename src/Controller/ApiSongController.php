<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiSongController extends AbstractController
{
    #[Route('api/songs/{id<\d+>}',  name: 'api_get_song')]
	public function getSong(int $id, LoggerInterface $logger): Response
    {
       //TODO: Query the database for the song data
       $song = [
        'id' => $id,
        'name' => 'Waterfalls',
        'url'   =>  'https://symfonycasts.s3.amazonaws.com/sample.mp3'
       ];

       $logger->info('Returning the json response for song {song}', ['song' => $id]);

       return new JsonResponse($song); //or return $this->json($song); //also works
    }
}