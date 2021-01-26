<?php
require_once("connexionToDatabase.php");

class Admin
{
    function __construct()
    {

    }

    public static function showAllUsers()
    {
        $request = connexionToDatabase()->prepare("SELECT id, username, email, admin, created_at FROM users");
        $reponse = $request->execute();
        while($reponse = $request->fetch())
        {?>
            <?php echo "<strong>N°" .$reponse['id']. "</strong>" . "-<strong> Username :</strong> " .$reponse['username']. "<strong> | Email : </strong>" .$reponse['email']."<strong> | Status User :</strong> " .$reponse['admin']. "<strong> | </strong>créé le " .$reponse['created_at']; ?><br />
            <p>
                <a class="modifier" href="editOneUser.php?id=<?= $reponse['id']; ?>"> Modifier | </a>
                <a class="supprimer" href="deleteUser.php?id=<?= $reponse['id']; ?>"> Supprimer</a><br /><hr>
            </p>
            <?php
        }
        $request->closeCursor();
    }

    public function editOneUser()
    {
        $usernameModif = htmlspecialchars($_POST['nom_modif']);
        $emailModif = htmlspecialchars($_POST['email_modif']);
        $statusAdminModif = htmlspecialchars($_POST['status_admin']);
        $getid = $_GET['id'];


        $request_username = connexionToDatabase()->prepare("UPDATE users SET username = :username WHERE id = :id");
        $reponse_username = $request_username->execute(array(
            "username" => $usernameModif,
            "id" => $getid
        ));
        $request_username->closeCursor();

        $request_email = connexionToDatabase()->prepare("UPDATE users SET email = :email WHERE id = :id");
        $reponse_email = $request_email->execute(array(
            "email" => $emailModif,
            "id" => $getid
        ));
        $request_email->closeCursor();

        $request_statusadmin = connexionToDatabase()->prepare("UPDATE users SET admin = :admin WHERE id = :id");
        $reponse_statusadmin = $request_statusadmin->execute(array(
            "admin" => $statusAdminModif,
            "id" => $getid
        ));
        $request_statusadmin->closeCursor();

        echo "Donnée(s) mise(s) à jour !<br />";

    }

    public function deleteUser()
    {
        $getid = $_GET['id'];
        echo "<script>alert('Cette suppression sera irréversible. Etes-vous sûr(e) ?');</script><br />";

        $request = connexionToDatabase()->prepare("DELETE FROM users WHERE id = :id");
        $reponse = $request->execute(array(
            "id" => $getid
        ));
        $request->closeCursor();
        echo "<br />Suppression réussie<br />";

    }
}



?>
