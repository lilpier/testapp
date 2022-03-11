<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EventRepository;
use App\Entity\Event;


class UserEventController extends AbstractController
{
    #[Route('/events', name: 'app_events', methods: ['GET'])]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('user_event/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    #[Route('/event/{id}', name: 'app_event', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('user_event/single_event.html.twig', [
            'event' => $event,
        ]);
    }
}
