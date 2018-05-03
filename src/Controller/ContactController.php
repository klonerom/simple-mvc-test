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
use Model\Contact;

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

        if ($contact) { //id existe => requete = true
            //civility object
            $civilityManager = new CivilityManager();
            $civilityContact = $civilityManager->selectOneById($contact->getCivilityId()); //contact civility (for selected in twig select)

            return $this->twig->render('Contact/show.html.twig', [
                'contact' => $contact,
                'civilityId' => $civilityContact,
            ]);

        } else {
            $_SESSION['message'] = ' Id inconnu ! Action annulée';

            header('Location: /');
            die;
        }
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
        //init
        $error = [];

        //Update asking
        if (!empty($_POST)) {
            $contactUpdate = [];

            //Test date form
            if (!empty($_POST['lastname'])) {
                $contactUpdate['lastname'] = $_POST['lastname'];
            } else {
                $error['lastname'] = 'le nom n\'est pas renseigné !';
            }

            if (!empty($_POST['firstname'])) {

                $contactUpdate['firstname'] = $_POST['firstname'];
            } else {
                $error['firstname'] = 'le prénom n\'est pas renseigné !';
            }

            if (!empty($_POST['civility'])) {
                $contactUpdate['civility_id'] = $_POST['civility'];
            } else {
                $error['civility'] = 'la civilité n\'est pas renseignée !';
            }

            //Form ok
            if (empty($error['lastname']) && empty($error['firstname']) && empty($error['civility'])) {

                //contact manager object
                $contactManager = new ContactManager();

                $contactManager->update($id, $contactUpdate);

                $_SESSION['message'] = $contactUpdate['lastname'].' '.$contactUpdate['firstname'].' est modifié(e) !';

                header('Location: /');
                die;
            }
        }

        //contact object
        $contactManager = new ContactManager();
        $contact = $contactManager->selectOneById($id);

        if ($contact) {//id existe => requete = true
            //civility object
            $civilityManager = new CivilityManager();
            $civilities = $civilityManager->selectAll(); //Complete list of civilities (for select in twig)

            return $this->twig->render('Contact/edit.html.twig', [
                'contact' => $contact,
                'civilities' => $civilities,
                'error' => $error,
            ]);

        } else {
            $_SESSION['message'] = ' Id inconnu ! Action annulée';

            header('Location: /');
            die;
        }
    }

    /**
     * Display item creation page
     *
     * @return string
     */
    public function add()
    {
        //init
        $contact = [];
        $error = [];

        //Update asking
        if (!empty($_POST)) {

            //Test date form
            if (!empty($_POST['lastname'])) {
                $contact['lastname'] = $_POST['lastname'];
            } else {
                $error['lastname'] = 'le nom n\'est pas renseigné !';
            }

            if (!empty($_POST['firstname'])) {
                $contact['firstname'] = $_POST['firstname'];
            } else {
                $error['firstname'] = 'le prénom n\'est pas renseigné !';
            }

            if (!empty($_POST['civility'])) {
               $contact['civility_id'] = (int) $_POST['civility']; //civility_id pour insert en bdd
            } else {
                $error['civility'] = 'la civilité n\'est pas renseignée !';
            }

            //Form ok => ajout en base + redirection sur list des contact (index)
            if (empty($error['lastname']) && empty($error['firstname']) && empty($error['civility'])) {

                //contact object
                $contactManager = new ContactManager();

                $contactManager->insert($contact);

                $_SESSION['message'] = $contact['lastname'].' '.$contact['firstname'].' est ajouté(e) !';

                header('Location: /');
                die;
            } else {
                //OK mais A revoir pour amélioration : dans cette methode on passe son un object contact->civilityId soit un tableau contact['civility_id'] alors que dans twig contact.civilityId demandé et contact_id en base.
                //  si object ok pour passer de contactId twig à contact_id en bdd (la class Contact est prévue pour)
                //Ici on passe un objet avec les données saisies mais non enregistrer en bdd car incomplète
                $contact = new Contact();
                $contact->setLastname($_POST['lastname']);
                $contact->setFirstname($_POST['firstname']);
                $contact->setCivilityId((int) $_POST['civility']);
            }
        }

        //civility object
        $civilityManager = new CivilityManager();
        $civilities = $civilityManager->selectAll(); //Complete list of civilities (for select in twig)

        return $this->twig->render('Contact/add.html.twig', [
            'contact' => $contact,
            'civilities' => $civilities,
            'error' => $error,
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

        if ($contact) {
            $contactManager->delete($id);

            $contacts = $contactManager->selectAll();

            $message = $contact->getLastname() . ' ' . $contact->getFirstname() . ' est supprimé !';

            return $this->twig->render('Contact/index.html.twig', [
                'contacts' => $contacts,
                'message' => $message,
            ]);

        } else {
        $_SESSION['message'] = ' Id inconnu ! Action annulée';

        header('Location: /');
        die;
        }
    }
}
