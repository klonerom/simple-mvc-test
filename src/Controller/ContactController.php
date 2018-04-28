<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\CivilityManager;
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
        $message = null;

        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $contactManager = new ContactManager();
        $contacts = $contactManager->selectAll();

        return $this->twig->render('Contact/index.html.twig', [
            'contacts' => $contacts,
            'message' => $message,
            ]);
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

        //civility object
        $civilityManager = new CivilityManager();
        $civilityContact = $civilityManager->selectOneById($contact->getCivilityId()); //contact civility (for selected in twig select)


        return $this->twig->render('Contact/show.html.twig', [
            'contact' => $contact,
            'civilityId' => $civilityContact,
            ]);
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
        //Update asking
        if (!empty($_POST)) {
            $contactUpdate = [];

            $contactUpdate = [
                //'id' => $id,
                'lastname' => $_POST['lastname'],
                'firstname' => $_POST['firstname'],
                'civility_id' => $_POST['civility'],
            ];

            //var_dump($contactUpdate);die;

            //contact object
            $contactManager = new ContactManager();

            $contactManager->update($id, $contactUpdate);

            $_SESSION['message'] = $contactUpdate['lastname'] . ' ' . $contactUpdate['firstname'] . ' est modifié(e) !';

            header('Location: /');
            die;
        }

        //contact object
        $contactManager = new ContactManager();
        $contact = $contactManager->selectOneById($id);

        //civility object
        $civilityManager = new CivilityManager();
        $civilities = $civilityManager->selectAll(); //Complete list of civilities (for select in twig)
        $civilityContact = $civilityManager->selectOneById($contact->getCivilityId()); //contact civility (for selected in twig select)

        return $this->twig->render('Contact/edit.html.twig', [
            'contact' => $contact,
            'civilityContact' => $civilityContact,
            'civilities' => $civilities,
        ]);
    }

    /**
     * Display item creation page
     *
     * @return string
     */
    public function add()
    {
        //Update asking
        if (!empty($_POST)) {
            $contactAdd = [];

            $contactAdd = [
                //'id' => $id,
                'lastname' => $_POST['lastname'],
                'firstname' => $_POST['firstname'],
                'civility_id' => $_POST['civility'],
            ];

            //contact object
            $contactManager = new ContactManager();

            $contactManager->insert($contactAdd);

            $_SESSION['message'] = $contactAdd['lastname'] . ' ' . $contactAdd['firstname'] . ' est ajouté(e) !';

            header('Location: /');
            die;
        }

        //civility object
        $civilityManager = new CivilityManager();
        $civilities = $civilityManager->selectAll(); //Complete list of civilities (for select in twig)

        return $this->twig->render('Contact/add.html.twig', [
            'civilities' => $civilities,
        ]);
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
        $message = null;

        $contactManager = new ContactManager();
        $contact = $contactManager->selectOneById($id);

        $contactManager->delete($id);

        $contacts = $contactManager->selectAll();

        $message = $contact->getLastname() . ' ' . $contact->getFirstname() . ' est supprimé !';

        return $this->twig->render('Contact/index.html.twig', [
            'contacts' => $contacts,
            'message' => $message,
        ]);
    }
}
