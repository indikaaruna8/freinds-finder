<?php

namespace In\Controller;

use In\Entity\Admin;
use In\Form\AdminType;
use In\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Lib\In\ListBundle\Service\Search;
use Lib\In\ListBundle\Request\JsgridSearchRequest as JSR;

class AdminController extends AbstractController
{
    #[Route('/admin', name: "app_admin_index", methods: ["GET"])]
    public function index(AdminRepository $adminRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'admins' => $adminRepository->findAll(),
        ]);
    }

    #[Route("/admin/data", name: "app_admin_data", methods:["GET"])]
    public function indexData(JSR $jsr, Search $s, AdminRepository $repo): Response
    {
        $fields = [
            'name' => ['field' => 'a.name', 'search' => true, 'args' => []],
            'created_date' => ['field' => 'a.createdAt', 'search' => true, 'args' => ['format' => 'd-M-y h:i:s A']]
        ];

        $paths = [
            'edit' => ['route_name' => 'app_admin_edit', 'param' => ['uuid' => 'uuid']],
            'show' => ['route_name' => 'app_admin_show', 'param' => ['uuid' => 'uuid']]
        ];

        $data = $s->getData($jsr, $repo, $fields, $paths);

        //return new Response('xxx');

        return  $this->json($data);
    }

    #[Route("/admin/new", name:"app_admin_new", methods:["GET", "POST"])]
    public function new(Request $request, AdminRepository $adminRepository): Response
    {
        $admin = new Admin();
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adminRepository->add($admin, true);
            $this->addFlash('success', 'Successfully Created.');
            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/new.html.twig', [
            'admin' => $admin,
            'form' => $form,
        ]);
    }

    #[Route("admin/{uuid}", name: "app_admin_show", methods: ["GET"])]
    public function show(Admin $admin): Response
    {
        return $this->render('admin/show.html.twig', [
            'admin' => $admin,
        ]);
    }


    #[Route("admin/{uuid}/edit", name: "app_admin_edit", methods: ["GET", "POST"])]
    public function edit(Request $request, Admin $admin, AdminRepository $adminRepository): Response
    {
        $form = $this->createForm(AdminType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adminRepository->add($admin, true);
            $this->addFlash('success', 'Successfully Updated.');
            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/edit.html.twig', [
            'admin' => $admin,
            'form' => $form,
        ]);
    }

    #[Route("admin/{uuid}", name: "app_admin_delete", methods: ["POST"])]
    public function delete(Request $request, Admin $admin, AdminRepository $adminRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$admin->getId(), $request->request->get('_token'))) {
            $adminRepository->remove($admin, true);
        }

        return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
