<?php

namespace App\Controller;

use App\Entity\AppUsers;
use App\Form\UserType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UsersController extends Controller
{
    /**
     * @Route("/users_list", name="users_list")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(AppUsers::class)->findAll();

        return $this->render('users/index.html.twig', array('users' => $users));
    }

    /**
     * @Route("/users/new", name="new_user")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $new_user = new AppUsers();

        $user = $this->createForm(UserType::class, $new_user);

        $user->offsetUnset('isDeleted');

        $user->handleRequest($request);

        if ($user->isSubmitted() and $user->isValid())
        {
            $new_user->setIsDeleted(false);

            $password = $passwordEncoder->encodePassword($new_user, $new_user->getPlainPassword());
            $new_user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($new_user);
            $em->flush();

            return $this->redirectToRoute('users_list');


        }

        return $this->render('users/new.html.twig', array (
            'user' => $user->createView()
        ));

    }

    /**
     * @Route("/users/edit/{id}", name="edit_user")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function edit(Request $request, $id, UserPasswordEncoderInterface $passwordEncoder)
    {
        $edit_user = $this->getDoctrine()->getRepository(AppUsers::class)->find($id);

        $user = $this->createForm(UserType::class, $edit_user);

        $user->offsetUnset('isDeleted');

        $user->handleRequest($request);

        if ($user->isSubmitted() and $user->isValid())
        {
            $password = $passwordEncoder->encodePassword($edit_user, $edit_user->getPlainPassword());
            $edit_user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('users_list');
        }

        return $this->render('users/edit.html.twig', array (
            'user' => $user->createView()
        ));

    }

    /**
     * @Route("/users/{id}", name="users_show")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function show($id)
    {
        $user = $this->getDoctrine()->getRepository(AppUsers::class)->find($id);

        return $this->render('users/show.html.twig', array ('user'=>$user));
    }

    /**
     * @Route("/users/delete/{id}")
     * @Method({"GET", "POST", "DELETE"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function delete($id)
    {
        $user = $this->getDoctrine()->getRepository(AppUsers::class)->find($id);

        $user->setIsDeleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('users_list');
    }
}
