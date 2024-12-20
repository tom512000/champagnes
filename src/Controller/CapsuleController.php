<?php

namespace App\Controller;

use App\Entity\Capsule;
use App\Form\CapsuleType;
use App\Repository\CapsuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\Form\Exception\OutOfBoundsException;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/')]
class CapsuleController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws BadRequestException
     */
    #[Route('/', name: 'app_capsule_index', methods: ['GET'])]
    public function index(CapsuleRepository $capsuleRepository, Request $request): Response
    {
        $query = $request->query->get('search');
        $capsules = $capsuleRepository->findBySearchQuery($query);

        $totalCapsules = array_reduce($capsules, function($carry, $capsule) {
            return $carry + $capsule->getQuantite();
        }, 0);

        $totalVarietes = count($capsules);

        return $this->render('capsule/index.html.twig', [
            'capsules' => $capsules,
            'totalCapsules' => $totalCapsules,
            'totalVarietes' => $totalVarietes,
        ]);
    }

    /**
     * @throws OutOfBoundsException
     * @throws RuntimeException
     * @throws ServiceNotFoundException
     * @throws LogicException
     */
    #[Route('/new', name: 'app_capsule_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $capsule = new Capsule();
        $form = $this->createForm(CapsuleType::class, $capsule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->extracted($form, $slugger, $capsule);

            $entityManager->persist($capsule);
            $entityManager->flush();

            return $this->redirectToRoute('app_capsule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('capsule/new.html.twig', [
            'capsule' => $capsule,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_capsule_show', methods: ['GET'])]
    public function show(Capsule $capsule): Response
    {
        return $this->render('capsule/show.html.twig', [
            'capsule' => $capsule,
        ]);
    }

    /**
     * @throws OutOfBoundsException
     * @throws RuntimeException
     * @throws ServiceNotFoundException
     * @throws LogicException
     */
    #[Route('/{id}/edit', name: 'app_capsule_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Capsule $capsule, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CapsuleType::class, $capsule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->extracted($form, $slugger, $capsule);

            $entityManager->flush();

            return $this->redirectToRoute('app_capsule_show', ['id' => $capsule->getId()]);
        }

        return $this->render('capsule/edit.html.twig', [
            'form' => $form->createView(),
            'capsule' => $capsule,
        ]);
    }

    /**
     * @throws BadRequestException
     */
    #[Route('/{id}', name: 'app_capsule_delete', methods: ['POST'])]
    public function delete(Request $request, Capsule $capsule, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$capsule->getId(), $request->request->get('_token'))) {
            $entityManager->remove($capsule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_capsule_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @param FormInterface $form
     * @param SluggerInterface $slugger
     * @param Capsule $capsule
     * @return void
     * @throws OutOfBoundsException
     * @throws ServiceNotFoundException|RuntimeException
     */
    public function extracted(FormInterface $form, SluggerInterface $slugger, Capsule $capsule): void
    {
        $image = $form->get('image')->getData();

        if ($image) {
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();

            $image->move(
                $this->getParameter('images_directory'),
                $newFilename
            );

            $capsule->setImage($newFilename);
        }
    }
}
