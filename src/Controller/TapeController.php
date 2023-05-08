<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TapeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
	public function homepage(): Response
    {
        $songData = [
            ['track' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['track' => 'Waterfalls', 'artist' => 'TLC'],
            ['track' => 'Creep', 'artist' => 'Radiohead'],
            ['track' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['track' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['track' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];
        $title = "PB & Jams";

        return $this->render('tape/homepage.html.twig',[
            'title' => $title,
            'songs' => $songData
        ]);
    }

    #[Route( '/browse/{slug}', name: 'app_browse' )]
    public function browse($slug = null): Response
    {
        $title = ucwords(str_replace('-',' ',$slug));
        $genre = $slug ? $title : null;
        return $this->render('tape/browse.html.twig',[
            'genre' => $genre,
        ]);
    }


}