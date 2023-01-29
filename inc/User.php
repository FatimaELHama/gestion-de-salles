<?php
class User
{
    private $errors = [];
    private $mysqli;

    public function connectDB($server, $username, $password, $database)
    {
        $mysqli = new mysqli($server, $username, $password, $database);
        if ($mysqli->connect_error) {
            die("Database Connection failed!");
        }
        $this->mysqli = $mysqli;
    }
    public function loginGest($email, $password)
    {
        if (empty(trim($email))) {
            $this->errors[] = "Please enter your email.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Please enter a valid email";
        } else {
            if (!$this->checkEmailGest($email)) {
                $this->errors[] = "Email address is not registered.";
            }
        }

        if (empty(trim($password))) {
            $this->errors[] = "Please enter your password.";
        }

        if (count($this->errors) == 0) {
            $stmt = $this->mysqli->prepare("SELECT * FROM gestionnaire WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];
            $password_verify = password_verify($password, $hashed_password);

            if ($password_verify) {
                $_SESSION['gestionnaire'] = $row['id'];
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['email'] = $row['email'];
            } else {
                $this->errors[] = "Password incorrect.";
            }
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
    public function checkEmailStag($email)
    {
        $stmt = $this->mysqli->prepare("SELECT email FROM stagiaires WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
    public function checkEmailGest($email)
    {
        $stmt = $this->mysqli->prepare("SELECT email FROM gestionnaire WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
    // Gestionnaire
    public function addStagiaire($cne, $nom, $prenom, $dateNaiss, $email, $telephone)
    {
        if (empty(trim($cne))) {
            $this->errors[] = "Veuillez entrer votre CNE";
        } else if (!preg_match("/^[0-9]+$/", $cne)) {
            $this->errors[] = "Votre CNE doit être un nombre.";
        }

        if (empty(trim($prenom))) {
            $this->errors[] = "Please enter first name.";
        } else if (strlen(trim($prenom)) < 2 || strlen(trim($prenom)) > 25) {
            $this->errors[] = "First name must be between 2 and 25 characters.";
        } else if (!preg_match("/^[a-zA-Z ]+$/", $prenom)) {
            $this->errors[] = "First name must contain only alphabets";
        }

        if (empty(trim($nom))) {
            $this->errors[] = "Please enter last name.";
        } else if (strlen(trim($nom)) < 2 || strlen(trim($nom)) > 25) {
            $this->errors[] = "Last name must be between 2 and 25 characters.";
        } else if (!preg_match("/^[a-zA-Z ]+$/", $nom)) {
            $this->errors[] = "Last name must contain only alphabets";
        }

        if (empty(trim($email))) {
            $this->errors[] = "Please enter email.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Please enter a valid email";
        }

        if (empty(trim($telephone))) {
            $this->errors[] = "Please enter phone number.";
        } else if (strlen(trim($telephone)) < 10  || strlen(trim($telephone)) > 15) {
            $this->errors[] = "Phone must be between 10 and 15 numbers.";
        } else if (!preg_match("/^[0-9]+$/", $telephone)) {
            $this->errors[] = "Phone must be a number";
        }

        if (empty(trim($dateNaiss))) {
            $this->errors[] = "Veuillez saisir votre date de naissance.";
        }

        if ($this->checkEmailStag($email)) {
            $this->errors[] = "Email already in use!";
        }

        if (count($this->errors) == 0) {
            $stmt = $this->mysqli->prepare("INSERT INTO stagiaires (CNE, nom, prenom, date_naiss, email, telephone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $cne, $nom, $prenom, $dateNaiss, $email, $telephone);
            $stmt->execute();
            $stmt->close();
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
    public function updateStagiaire($id, $cne, $nom, $prenom, $dateNaiss, $email, $telephone)
    {
        if (empty(trim($cne))) {
            $this->errors[] = "Veuillez entrer votre CNE";
        } else if (!preg_match("/^[0-9]+$/", $cne)) {
            $this->errors[] = "Votre CNE doit être un nombre.";
        }

        if (empty(trim($prenom))) {
            $this->errors[] = "Please enter first name.";
        } else if (strlen(trim($prenom)) < 2 || strlen(trim($prenom)) > 25) {
            $this->errors[] = "First name must be between 2 and 25 characters.";
        } else if (!preg_match("/^[a-zA-Z ]+$/", $prenom)) {
            $this->errors[] = "First name must contain only alphabets";
        }

        if (empty(trim($nom))) {
            $this->errors[] = "Please enter last name.";
        } else if (strlen(trim($nom)) < 2 || strlen(trim($nom)) > 25) {
            $this->errors[] = "Last name must be between 2 and 25 characters.";
        } else if (!preg_match("/^[a-zA-Z ]+$/", $nom)) {
            $this->errors[] = "Last name must contain only alphabets";
        }

        if (empty(trim($email))) {
            $this->errors[] = "Please enter email.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Please enter a valid email";
        }

        if (empty(trim($telephone))) {
            $this->errors[] = "Please enter phone number.";
        } else if (strlen(trim($telephone)) < 10  || strlen(trim($telephone)) > 15) {
            $this->errors[] = "Phone must be between 10 and 15 numbers.";
        } else if (!preg_match("/^[0-9]+$/", $telephone)) {
            $this->errors[] = "Phone must be a number";
        }

        if (empty(trim($dateNaiss))) {
            $this->errors[] = "Veuillez saisir votre date de naissance.";
        }

        if (count($this->errors) == 0) {
            $stmt = $this->mysqli->prepare("UPDATE stagiaires SET CNE = ?, nom = ?, prenom = ?, date_naiss = ?, email = ?, telephone = ? WHERE id = ?");
            $stmt->bind_param("isssssi", $cne, $nom, $prenom, $dateNaiss, $email, $telephone, $id);
            $stmt->execute();
            $stmt->close();
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
    public function getStagiaire($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM stagiaires WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getStagiaires()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM stagiaires");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getStagiairesPaginated($paginationStart, $limit)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM stagiaires ORDER BY `id` ASC LIMIT $paginationStart, $limit");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function deleteStagiare($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM stagiaires WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return ["status" => "success"];
        } else {
            return ["status" => "error"];
        }
        $stmt->close();
    }

    // Salles
    public function addSalle($nom, $location)
    {
        if (empty(trim($nom))) {
            $this->errors[] = "Veuillez saisir le nom de la module.";
        } else if (strlen(trim($nom)) < 2) {
            $this->errors[] = "Le nom du modulle doit comporter plus de 2 caractères.";
        } else if (!preg_match("/^([a-zA-Z0-9\s\_\-]+)$/", $nom)) {
            $this->errors[] = "Le nom de la module doit contenir uniquement des alphabets.";
        }
        if (empty(trim($location))) {
            $this->errors[] = "Veuillez saisir location du salle";
        } else if (strlen(trim($location)) < 2) {
            $this->errors[] = "Le nom du location doit comporter plus de 2 caractères.";
        } else if (!preg_match("/^([a-zA-Z0-9\s\_\-]+)$/", $location)) {
            $this->errors[] = "Le nom de la location doit contenir uniquement des alphabets.";
        }

        if (count($this->errors) == 0) {
            $stmt = $this->mysqli->prepare("INSERT INTO salles (nom, location) VALUES (?, ?)");
            $stmt->bind_param("ss", $nom, $location);
            $stmt->execute();
            $stmt->close();
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
    public function updateSalle($id, $nom, $location)
    {
        if (empty(trim($nom))) {
            $this->errors[] = "Veuillez saisir le nom de la module.";
        } else if (strlen(trim($nom)) < 2) {
            $this->errors[] = "Le nom du modulle doit comporter plus de 2 caractères.";
        } else if (!preg_match("/^([a-zA-Z0-9\s\_\-]+)$/", $nom)) {
            $this->errors[] = "Le nom de la module doit contenir uniquement des alphabets.";
        }
        if (empty(trim($location))) {
            $this->errors[] = "Veuillez saisir location du salle";
        } else if (strlen(trim($location)) < 2) {
            $this->errors[] = "Le nom du location doit comporter plus de 2 caractères.";
        } else if (!preg_match("/^([a-zA-Z0-9\s\_\-]+)$/", $location)) {
            $this->errors[] = "Le nom de la location doit contenir uniquement des alphabets.";
        }
        if (count($this->errors) == 0) {
            $stmt = $this->mysqli->prepare("UPDATE salles SET nom = ?, location = ? WHERE id = ?");
            $stmt->bind_param("ssi", $nom, $location, $id);
            $stmt->execute();
            $stmt->close();
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
    public function getSalle($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM salles WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getSalles()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM salles");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getSallesPaginated($paginationStart, $limit)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM salles ORDER BY `id` DESC LIMIT $paginationStart, $limit");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function deleteSalle($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM salles WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return ["status" => "success"];
        } else {
            return ["status" => "error"];
        }
        $stmt->close();
    }
    // Groupes
    public function addGroupe($title)
    {
        if (empty(trim($title))) {
            $this->errors[] = "Veuillez saisir le nom de la groupe.";
        } else if (strlen(trim($title)) < 2) {
            $this->errors[] = "Le nom du groupe doit comporter plus de 2 caractères.";
        } else if (!preg_match("/^([a-zA-Z0-9\s\_\-]+)$/", $title)) {
            $this->errors[] = "Seuls les lettres, les chiffres, le tiret, le trait de soulignement ou l'espace sont autorisés pour le nom de groupe.";
        }

        if (count($this->errors) == 0) {
            $stmt = $this->mysqli->prepare("INSERT INTO groupes (nom_groupe) VALUES (?)");
            $stmt->bind_param("s", $title);
            $stmt->execute();
            $stmt->close();
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
    public function updateGroupe($id, $title)
    {
        if (empty(trim($title))) {
            $this->errors[] = "Veuillez saisir le nom de la groupe.";
        } else if (strlen(trim($title)) < 2) {
            $this->errors[] = "Le nom du groupe doit comporter plus de 2 caractères.";
        } else if (!preg_match("/^([a-zA-Z0-9\s\_\-]+)$/", $title)) {
            $this->errors[] = "Seuls les lettres, les chiffres, le tiret, le trait de soulignement ou l'espace sont autorisés pour le nom de groupe.";
        }
        if (count($this->errors) == 0) {
            $stmt = $this->mysqli->prepare("UPDATE groupes SET nom_groupe = ? WHERE id = $id");
            $stmt->bind_param("s", $title);
            $stmt->execute();
            $stmt->close();
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
    public function getGroupe($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM groupes WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getGroupeStagiaire($groupe)
    {
        $stmt = $this->mysqli->prepare("SELECT st.id, st.nom, st.prenom, st.CNE FROM stagiaires AS st INNER JOIN etudier_groupe AS et ON st.id = et.id_stagiaire WHERE et.id_groupe = ?");
        $stmt->bind_param("i", $groupe);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getGroupes()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM groupes");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getGroupesPaginated($paginationStart, $limit)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM groupes ORDER BY `id` DESC LIMIT $paginationStart, $limit");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function assignGroupe($id, $groupe)
    {
        $stmt = $this->mysqli->prepare("SELECT id_stagiaire FROM etudier_groupe WHERE id_stagiaire = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($result) == 0) {
            $stmt = $this->mysqli->prepare("INSERT INTO etudier_groupe (id_stagiaire, id_groupe) VALUES (?, ?)");
            $stmt->bind_param("ii", $id, $groupe);
            if ($stmt->execute()) {
                return ["status" => "success"];
            }
        } else {
            $stmt = $this->mysqli->prepare("UPDATE etudier_groupe SET id_groupe = ? WHERE id_stagiaire = ?");
            $stmt->bind_param("ii", $groupe, $id);
            if ($stmt->execute()) {
                return ["status" => "success"];
            }
        }
    }
    public function deleteGroupe($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM groupes WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return ["status" => "success"];
        } else {
            return ["status" => "error"];
        }
        $stmt->close();
    }

    public function addGroupeEmploi($id_groupe, $lundi_m, $lundi_a, $mardi_m, $mardi_a, $mercredi_m, $mercredi_a, $jeudi_m, $jeudi_a, $vendredi_m, $vendredi_a, $samedi_m, $samedi_a)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO emploi (id_groupe, m_lundi, ap_lundi, m_mardi, ap_mardi, m_mercredi, ap_mercredi, m_jeudi, ap_jeudi, m_vendredi, ap_vendredi, m_samedi, ap_samedi) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssssssss", $id_groupe, $lundi_m, $lundi_a, $mardi_m, $mardi_a, $mercredi_m, $mercredi_a, $jeudi_m, $jeudi_a, $vendredi_m, $vendredi_a, $samedi_m, $samedi_a);
        if ($stmt->execute()) {
            return ["status" => "success"];
        } else {
            return ["status" => "error"];
        }
        $stmt->close();
    }

    public function updateGroupeEmploi($id_groupe, $lundi_m, $lundi_a, $mardi_m, $mardi_a, $mercredi_m, $mercredi_a, $jeudi_m, $jeudi_a, $vendredi_m, $vendredi_a, $samedi_m, $samedi_a)
    {
        $stmt = $this->mysqli->prepare("UPDATE emploi SET m_lundi = ?, ap_lundi = ?, m_mardi = ?, ap_mardi = ?, m_mercredi = ?, ap_mercredi = ?, m_jeudi = ?, ap_jeudi = ?, m_vendredi = ?, ap_vendredi = ?, m_samedi = ?, ap_samedi = ? WHERE id_groupe = ?");
        $stmt->bind_param("ssssssssssssi", $lundi_m, $lundi_a, $mardi_m, $mardi_a, $mercredi_m, $mercredi_a, $jeudi_m, $jeudi_a, $vendredi_m, $vendredi_a, $samedi_m, $samedi_a, $id_groupe);
        if ($stmt->execute()) {
            return ["status" => "success"];
        } else {
            return ["status" => "error"];
        }
        $stmt->close();
    }
    public function checkDispo($input, $column)
    {

        if ($column == 'm_lundi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE m_lundi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'ap_lundi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE ap_lundi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'm_mardi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE m_mardi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'ap_mardi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE ap_mardi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'm_mercredi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE m_mercredi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'ap_mercredi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE ap_mercredi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'm_jeudi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE m_jeudi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'ap_jeudi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE ap_jeudi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'm_vendredi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE m_vendredi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'ap_vendredi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE ap_vendredi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'm_samedi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE ap_samedi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        } else if ($column == 'ap_samedi') {
            $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE ap_samedi = ?");
            $stmt->bind_param("s", $input);

            $stmt->execute();
            $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($results) >= 1) {
                return 0;
            } else {
                return 1;
            }
        }
    }

    public function getEmplois()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM emploi");
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }
    public function getEmploi($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM emploi WHERE id_groupe = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    }

    public function checkEmploi($id)
    {
        $stmt = $this->mysqli->prepare("SELECT id FROM emploi WHERE id_groupe = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($results) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEmploi($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM emploi WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return ["status" => "success"];
        } else {
            return ["status" => "error"];
        }
        $stmt->close();
    }

    // Gestionnaire
    public function gestChangePassword($id, $currentPassword, $newPassword, $confirmNewPassword)
    {
        if (empty(trim($newPassword))) {
            $this->errors[] = "Please enter a password.";
        } else if (strlen($newPassword) < 6) {
            $this->errors[] = "Password must be minimum of 6 characters";
        }

        if (empty(trim($confirmNewPassword)) && !empty(trim($newPassword))) {
            $this->errors[] = "Please confirm password.";
        } else if (!empty(trim($newPassword)) && $newPassword != $confirmNewPassword) {
            $this->errors[] = "Password and Confirm Password doesn't match";
        }

        $stmt = $this->mysqli->prepare("SELECT password FROM gestionnaire WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        $password_verify = password_verify($currentPassword, $hashed_password);
        if (!$password_verify) {
            $this->errors[] = "Current password is not correct.";
        }

        if (count($this->errors) == 0) {
            $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->mysqli->prepare("UPDATE gestionnaire SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $password_hash, $id);
            $stmt->execute();
            $stmt->close();
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
    public function updateGestionnaireProfile($id, $nom, $prenom)
    {
        if (empty(trim($prenom))) {
            $this->errors[] = "Please enter first name.";
        } else if (strlen(trim($prenom)) < 2 || strlen(trim($prenom)) > 25) {
            $this->errors[] = "First name must be between 2 and 25 characters.";
        } else if (!preg_match("/^[a-zA-Z ]+$/", $prenom)) {
            $this->errors[] = "First name must contain only alphabets";
        }

        if (empty(trim($nom))) {
            $this->errors[] = "Please enter last name.";
        } else if (strlen(trim($nom)) < 2 || strlen(trim($nom)) > 25) {
            $this->errors[] = "Last name must be between 2 and 25 characters.";
        } else if (!preg_match("/^[a-zA-Z ]+$/", $nom)) {
            $this->errors[] = "Last name must contain only alphabets";
        }

        if (count($this->errors) == 0) {
            $stmt = $this->mysqli->prepare("UPDATE gestionnaire SET nom = ?, prenom = ? WHERE id = $id");
            $stmt->bind_param("ss", $nom, $prenom);

            if ($stmt->execute()) {
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
            }
            $stmt->close();
        }

        if (count($this->errors) > 0) {
            return $this->errors;
        } else {
            return ["status" => "success"];
        }
    }
}
