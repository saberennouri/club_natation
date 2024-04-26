            --- reset auto increment after delete recording
            set @num:=0;
            update athletes set athlete_id= @num:= (@num+1);
            alter table athletes auto_increment=1;

            --- join tow tables
            SELECT p.prenom AS prenom_parent,p.nom AS nom_parent, a.nom AS nom_athlete, a.prenom AS 
            prenonom_athlete,a.athlete_id, a.date_naissance ,a.sexe,c.nom as nom_coach, c.prenom as prenom_coach 
            FROM parents p 
            INNER JOIN athletes a ON p.parent_id = a.parent_id INNER JOIN coachs c ON a.coach_id=c.coach_id; 
            -- afficher les commités
            SELECT comites.*, evenements.nom AS nomevent 
            FROM comites
            INNER JOIN comites_evenements ON comites.comite_id = comites_evenements.comite_id 
            INNER JOIN evenements ON comites_evenements.event_id = evenements.event_id;
            --- affichage compétitions
            SELECT Competitions.*, resultats_competitions.Position, Resultats_Competitions.Temps
            FROM Competitions 
            JOIN Resultats_Competitions ON Competitions.competition_id = resultats_competitions.competition_id;


            -- Créer la table sessionsentrainement
            CREATE TABLE sessionsentrainement (
                session_id INT AUTO_INCREMENT PRIMARY KEY,
                date DATE,
                lieu VARCHAR(100),
                activite VARCHAR(100),
                entraineur_id INT,
                athlete_id INT,
                FOREIGN KEY (entraineur_id) REFERENCES entraineurs(entraineur_id),
                FOREIGN KEY (athlete_id) REFERENCES athletes(athlete_id)
            );

            -- Requête pour récupérer les données avec jointures
            SELECT sessionsentrainement.*, heuresentrainement.heure, equipe.nom,entraineurs.nom as nomentraineur 
            FROM  sessionsentrainement
            INNER JOIN heuresentrainement ON sessionsentrainement.session_id = heuresentrainement.session_id
            INNER JOIN equipe ON heuresentrainement.equipe_id=equipe.id_equipe
            INNER JOIN entraineurs ON entraineurs.entraineur_id=sessionsentrainement.entraineur_id
   
