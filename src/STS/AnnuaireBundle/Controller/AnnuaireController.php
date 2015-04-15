<?php

namespace STS\AnnuaireBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use STS\AnnuaireBundle\Entity\Annuaire;
use STS\AnnuaireBundle\Form\AnnuaireType;

/**
 * Annuaire controller.
 *
 * @Route("/")
 * @Route("/annuaire")
 */
class AnnuaireController extends Controller {

    /**
     * Lists all Annuaire entities.
     *
     * @Route("/", name="annuaire")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('STSAnnuaireBundle:Annuaire')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Annuaire entity.
     *
     * @Route("/", name="annuaire_create")
     * @Method("POST")
     * @Template("STSAnnuaireBundle:Annuaire:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Annuaire();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        // mise en forme
        $entity->setNom( $this->capitalize($entity->getNom()) );
        $entity->setPrenom( $this->capitalize($entity->getPrenom()) );

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('annuaire_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Annuaire entity.
     *
     * @param Annuaire $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Annuaire $entity) {
        $form = $this->createForm(new AnnuaireType(), $entity, array(
            'action' => $this->generateUrl('annuaire_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal')
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Sauvegarder',
            'attr' => array('class' => 'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Annuaire entity.
     *
     * @Route("/new", name="annuaire_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Annuaire();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Annuaire entity.
     *
     * @Route("/{id}", name="annuaire_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('STSAnnuaireBundle:Annuaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annuaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Annuaire entity.
     *
     * @Route("/{id}/edit", name="annuaire_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('STSAnnuaireBundle:Annuaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annuaire entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Annuaire entity.
     *
     * @param Annuaire $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Annuaire $entity) {
        $form = $this->createForm(new AnnuaireType(), $entity, array(
            'action' => $this->generateUrl('annuaire_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal')
        ));

        $form->add('submit', 'submit', array('label' => 'Mettre à jour', 'attr' => array('class' => 'btn btn-primary text-center')));

        return $form;
    }

    /**
     * Edits an existing Annuaire entity.
     *
     * @Route("/{id}", name="annuaire_update")
     * @Method("PUT")
     * @Template("STSAnnuaireBundle:Annuaire:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('STSAnnuaireBundle:Annuaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annuaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        // mise en forme
        $entity->setNom( $this->capitalize($entity->getNom()) );
        $entity->setPrenom( $this->capitalize($entity->getPrenom()) );

        if ($editForm->isValid()) {
            $em->flush();

            // redirection
            return $this->redirect($this->generateUrl('annuaire'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Annuaire entity.
     *
     * @Route("/{id}", name="annuaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('STSAnnuaireBundle:Annuaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Annuaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('annuaire'));
    }

    /**
     * Creates a form to delete a Annuaire entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('annuaire_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Supprimer', 'attr' => array('class' => 'btn btn-primary')))
                        ->getForm()
        ;
    }

    /** capitalize names
     * 
     * @param string $str
     * @return string
     */
    public function capitalize($str) {
        $str = strtolower($str);
        $str = ucwords($str);
        return $str;
    }
}
