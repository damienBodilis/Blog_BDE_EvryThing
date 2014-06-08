<?php
// src/EvryThing/BlogBundle/Controller/BlogController.php

namespace EvryThing\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use EvryThing\BlogBundle\Entity\Blog;
use EvryThing\BlogBundle\Form\BlogType;
use EvryThing\UserBundle\Entity\User;
use EvryThing\BlogBundle\Entity\Commentaire;
use EvryThing\BlogBundle\Form\CommentaireType;

/**
 * Blog controller.
 */
class BlogController extends Controller
{
        public function accueilAction($page)
	{
		// On ne sait pas combien de pages il y a
		// Mais on sait qu'une page doit être supérieure ou égale à 1
		if( $page < 1 )
		{
		  // On déclenche une exception NotFoundHttpException
		  // Cela va afficher la page d'erreur 404 (on pourra personnaliser cette page plus tard d'ailleurs)
		  throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
		}

		// On récupère le repository
	 /* $repository = $this->getDoctrine()
						 ->getManager()
						 ->getRepository('EvryThingBlogBundle:Blog');

	  // On récupère tout les champs de l'entité 
	  $articles = $repository->findAll();*/
	  
	    $em    = $this->get('doctrine.orm.entity_manager');
		$dql   = "SELECT a FROM EvryThingBlogBundle:Blog a";
		$query = $em->createQuery($dql);

		$paginator  = $this->get('knp_paginator');
		$articles = $paginator->paginate($query,$this->get('request')->query->get('page', $page), 5);

			
		return $this->render('EvryThingBlogBundle:Blog:accueil.html.twig', array('articles' => $articles));
	}
	public function renderCommentaireAction()
	{
		$commentaire = new Commentaire();
		$form = $this->createForm(new CommentaireType(), $commentaire);
		$user = $this->container->get('security.context')->getToken()->getUser();
		$request = $this->getRequest();
		if($request->getMethod() == 'POST'){
			$form->bind($request);
			if ($form->isValid()){	
				$commentaire->setAuteur($user->getUsername());
				$commentaire->setDate(new \DateTime('now'));
				$repository = $this->getDoctrine()->getManager()->getRepository('EvryThingBlogBundle:Blog');
				$blog = $repository->find($_POST['blog']);
				$commentaire->setBlog($blog);
				$em = $this->getDoctrine()->getManager();
				$em->persist($commentaire);
				$em->flush();
				return $this->redirect('EvryThingBlogBundle:Blog:accueil.html.twig');
			}
		}		
		return $this->render('EvryThingBlogBundle:Blog:formCommentaire.html.twig', array('form' => $form->createView()));
	}

    /**
     * Show a blog entry
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('EvryThingBlogBundle:Blog')->find($id);

        if (!$blog) 
        {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('EvryThingBlogBundle:Blog:show.html.twig', array('blog'=> $blog, ));
    }

    public function addAction()
    {
		$blog = new Blog();
		$form = $this->createForm(new BlogType(), $blog);
		$user = $this->container->get('security.context')->getToken()->getUser();
		$request = $this->getRequest();
		if($request->getMethod() == 'POST'){
			$form->bind($request);
			if ($form->isValid()){	
				$blog->upload();
				$blog->setAuthor($user->getUsername());
				$blog->setCreated(new \DateTime('now'));
				$blog->setUpdated(new \DateTime('now'));
				$em = $this->getDoctrine()->getManager();
				$em->persist($blog);
				$em->flush();
				return $this->redirect('EvryThingBlogBundle:Blog:accueil.html.twig');
			}
		}
		return $this->render('EvryThingBlogBundle:Blog:add.html.twig', array('form' => $form->createView()));
    }

    public function modifyAction($id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('EvryThingBlogBundle:Blog')->find($id);
        if (!$blog) 
        {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new BlogType(), $blog);

       if($request->getMethod() == 'POST')
       {
           $form->bind($request);

           if($form->isValid())
           {
                $blog->setAuthor($user->getUsername());
                $blog->setUpdated(new \DateTime('now'));
                $em->flush();
                return $this->redirect($this->generateUrl('evry_thing_blog_add'));
           }
       }

        return $this->render('EvryThingBlogBundle:Blog:modify.html.twig', array('form' => $form->createView(), 'blog' => $blog));
    }

    public function deleteAction($id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('EvryThingBlogBundle:Blog')->find($id);
        if (!$blog) 
        {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        
        $em->remove($blog);
        $em->flush();

        return $this->redirect($this->generateUrl('evry_thing_blog_add'));
    }
}
