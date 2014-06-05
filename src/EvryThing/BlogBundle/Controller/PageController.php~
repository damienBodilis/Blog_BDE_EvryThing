<?php
// src/EvryThing/BlogBundle/Controller/PageController.php

namespace EvryThing\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;
use EvryThing\BlogBundle\Entity\Enquiry;
use EvryThing\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{
    public function contactAction()
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') 
        {
            $form->bind($request);

            if ($form->isValid()) 
	    {
                $message = \Swift_Message::newInstance()
                         ->setSubject('Contact enquiry')
                         ->setFrom('enquiries@bde-evry.com')
                         ->setTo($this->container->getParameter('evry_thing_blog.emails.contact_email'))
                         ->setBody($this->renderView('EvryThingBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
        $this->get('mailer')->send($message);

        //$this->get('session')->setFlash('notice', 'Formulaire envoyé ;-)');

                return $this->redirect($this->generateUrl('evry_thing_blog_contact'));
            }
        }

        return $this->render('EvryThingBlogBundle:Page:contact.html.twig', array('form' => $form->createView()));
    }
}
