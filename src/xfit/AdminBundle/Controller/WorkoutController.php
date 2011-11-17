<?php

namespace xfit\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use xfit\AdminBundle\Entity\Workout;
use xfit\AdminBundle\Form\WorkoutType;

/**
 * Workout controller.
 *
 * @Route("/workout")
 */
class WorkoutController extends Controller
{
    /**
     * Lists all Workout entities.
     *
     * @Route("/", name="workout")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('xfitAdminBundle:Workout')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Workout entity.
     *
     * @Route("/{id}/show", name="workout_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('xfitAdminBundle:Workout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Workout entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Workout entity.
     *
     * @Route("/new", name="workout_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Workout();
        $form   = $this->createForm(new WorkoutType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Workout entity.
     *
     * @Route("/create", name="workout_create")
     * @Method("post")
     * @Template("xfitAdminBundle:Workout:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Workout();
        $request = $this->getRequest();
        $form    = $this->createForm(new WorkoutType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('workout_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Workout entity.
     *
     * @Route("/{id}/edit", name="workout_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('xfitAdminBundle:Workout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Workout entity.');
        }

        $editForm = $this->createForm(new WorkoutType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Workout entity.
     *
     * @Route("/{id}/update", name="workout_update")
     * @Method("post")
     * @Template("xfitAdminBundle:Workout:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('xfitAdminBundle:Workout')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Workout entity.');
        }

        $editForm   = $this->createForm(new WorkoutType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('workout_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Workout entity.
     *
     * @Route("/{id}/delete", name="workout_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('xfitAdminBundle:Workout')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Workout entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('workout'));
    }

    /**
     * Deletes a Workout entity.
     *
     * @Route("/{id}/email", name="workout_email")
     * @Method("post")
     */
    public function emailAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('xfitAdminBundle:Workout')->find($id);

        $emails = $em->getRepository('xfitAdminBundle:Email')->findAll();

        foreach ($emails as $email)
        {
            $message = \Swift_Message::newInstance()
                ->setSubject('X Fit Workout ' . $entity->getWorkoutDate()->format("Y-m-d"))
                ->setFrom('kyle.partridge@sendgrid.com')
                ->setTo($email->getEmail())
                ->setBody($this->renderView('xfitAdminBundle:Workout:email.txt.twig', array('entity' => $entity, 'name' => $email->getName())))
            ;

            $this->get('mailer')->send($message);
        }

        return $this->redirect($this->generateUrl('workout'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
