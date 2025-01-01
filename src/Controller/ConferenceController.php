<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Request $request): Response
    {
        // return $this->render('conference/index.html.twig', [
        //     'controller_name' => 'ConferenceController',
        // ]);

        $greet = '';

        if($name = $request->query->get('hello')) $greet = sprintf('<h1>Hello %s!</h1>', htmlspecialchars($name));

        dump($request);

        return new Response(
            <<<EOF
                <html>
                    <body>
                        <p>Under Construction</p>
                        <p>$greet</p>
                    </body>
                </html>
            EOF
        );
    }
}
