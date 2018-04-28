<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\ContactManager;

/**
 * Class ItemController
 *
 */
class ContactController extends AbstractController
{

    /**
     * Display contact listing
     *
     * @return string
     */
    public function index()
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->selectAll();

        return $this->twig->render('Contact/index.html.twig', ['contacts' => $contacts]);
    }

    /**
     * Display item informations specified by $id
     *
     * @param  int $id
     *
     * @return string
     */
    public function show(int $id)
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->selectOneById($id);

        return $this->twig->render('Contact/show.html.twig', ['item' => $item]);
    }

    /**
     * Display item edition page specified by $id
     *
     * @param  int $id
     *
     * @return string
     */
    public function edit(int $id)
    {
        // TODO : edit item with id $id
        return $this->twig->render('Contact/edit.html.twig', ['item', $id]);
    }

    /**
     * Display item creation page
     *
     * @return string
     */
    public function add()
    {
        // TODO : add a new item
        return $this->twig->render('Contact/add.html.twig');
    }

    /**
     * Display item delete page
     *
     * @param  int $id
     *
     * @return string
     */
    public function delete(int $id)
    {
        // TODO : delete the item with id $id
        return $this->twig->render('Contact/index.html.twig');
    }
}
