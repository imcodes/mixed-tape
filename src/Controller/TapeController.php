<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TapeController
{
    #[Route('/')]
	public function homepage(): Response
    {
        return new Response('Hello dear! You are welcom to Symfny world');
    }

    #[Route('/browse/{slug}')]
    public function browse($slug = null): Response
    {
        $title = ucwords(str_replace('-',' ',$slug));
        $res = $slug ? 'Genre: '.$title : 'You are browsing the Music List Index page';
        return new Response($res);
    }


}