DROP TABLE if exists UTILISATEUR cascade;
DROP TABLE if exists CLUB cascade;
DROP TABLE if exists NEWS cascade;
DROP TABLE if exists COMMENTAIRE cascade;
DROP TABLE if exists S_ABONNER cascade;

-- -----------------------------------------------------------------------------
--       TABLE : UTILISATEUR
-- -----------------------------------------------------------------------------

CREATE TABLE UTILISATEUR(
	ID_UTI serial NOT NULL,
    ID_CLUB int NOT NULL,
    NOM_UTI varchar(30) NOT NULL,
    PRENOM_UTI varchar(30) NOT NULL,
    SEXE_UTI varchar(15) NOT NULL,
    PASSWORD_UTI varchar(64) NOT NULL CHECK(LENGTH(PASSWORD_UTI) >= 12 AND
											PASSWORD_UTI ~ '[A-Z]' AND
											PASSWORD_UTI ~ '[a-z]' AND
											PASSWORD_UTI ~ '[0-9]' AND
											PASSWORD_UTI ~ '[!@#$%^&*()-=_+{}|;:,.<>?/]'),
	DATE_INSCRIPTION date DEFAULT CURRENT_DATE,
    IMAGE_UTI text NULL,
    MAIL_UTI text NULL,
	CONSTRAINT PK_UTILISATEUR PRIMARY KEY (ID_UTI),
    CONSTRAINT UC_UTILISATEUR_MAIL_UTI UNIQUE (MAIL_UTI)
);

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE UTILISATEUR
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_UTILISATEUR_CLUB ON UTILISATEUR (ID_CLUB);

-- -----------------------------------------------------------------------------
--       TABLE : CLUB
-- -----------------------------------------------------------------------------

CREATE TABLE CLUB (
	ID_CLUB serial NOT NULL,
    NOM_CLUB varchar(128) NOT NULL,
    LIGUE_CLUB char(2) NOT NULL,
    CONSTRAINT PK_CLUB PRIMARY KEY (ID_CLUB)
);

-- -----------------------------------------------------------------------------
--       TABLE : NEWS
-- -----------------------------------------------------------------------------

CREATE TABLE NEWS (
    ID_NEWS serial NOT NULL,
    ID_CLUB int NOT NULL,
	TITRE_NEWS varchar NOT NULL,
    ARTICLE_NEWS varchar NOT NULL,
    CONSTRAINT PK_NEWS PRIMARY KEY (ID_NEWS),
	CONSTRAINT FK_NEWS_CLUB FOREIGN KEY (ID_CLUB) REFERENCES club (ID_CLUB)
);

CREATE  INDEX I_FK_NEWS_CLUB
     ON NEWS (ID_CLUB)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : COMMENTAIRE
-- -----------------------------------------------------------------------------

CREATE TABLE COMMENTAIRE (
	ID_COMMENTAIRE serial NOT NULL,
	ID_NEWS int NOT NULL,
	ID_UTI int NULL,
	DESC_COM varchar NOT NULL,
	CONSTRAINT PK_COMMENTAIRE PRIMARY KEY (ID_COMMENTAIRE),
	CONSTRAINT FK_COMMENTAIRE_NEWS FOREIGN KEY (ID_NEWS) REFERENCES news (ID_NEWS),
	CONSTRAINT FK_COMMENTAIRE_UTI FOREIGN KEY (ID_UTI) REFERENCES utilisateur (ID_UTI)
);

-- -----------------------------------------------------------------------------
--       TABLE : S_ABONNER
-- -----------------------------------------------------------------------------

CREATE TABLE S_ABONNER (
	ID_UTI int NOT NULL,
	ID_CLUB int NOT NULL,   
	CONSTRAINT PK_S_ABONNER PRIMARY KEY (ID_UTI, ID_CLUB)
) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE S_ABONNER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_S_ABONNER_UTILISATEUR ON S_ABONNER (ID_UTI);
CREATE  INDEX I_FK_S_ABONNER_CLUB ON S_ABONNER (ID_CLUB);

-- -----------------------------------------------------------------------------
--                INSERT des CLUBS
-- -----------------------------------------------------------------------------

INSERT INTO club VALUES
(default,'Paris-SG'  ,'L1'),
(default,'Lens' 	, 'L1'),
(default,'Lorient' 	 ,'L1'),
(default,'Rennes' 	, 'L1'),
(default,'Marseille' ,'L1'),
(default,'Lille' 	, 'L1'),
(default,'Monaco'	, 'L1'),
(default,'Lyon' 	, 'L1'),
(default,'Clermont' , 'L1'),
(default,'Toulouse' , 'L1'),
(default,'Troyes'	, 'L1'),
(default,'Nice' 	, 'L1'),
(default,'Montpellier','L1'),
(default,'Reims' 	, 'L1'),
(default,'Nantes'	, 'L1'),
(default,'Strasbourg','L1'),
(default,'Brest' 	, 'L1'),
(default,'Auxerre'	 ,'L1'),
(default,'AC Ajaccio','L1'),
(default,'Angers'    ,'L1');

INSERT INTO utilisateur (id_club, nom_uti, prenom_uti, mail_uti, password_uti, sexe_uti, image_uti) VALUES
(1, 'Dupont', 'Jean', 'dupont.jean@freee.fr', 'p@ssw0rd1dEux3', 'Homme', 'cHhBcnQucG5n'),
(1, 'Michelle', 'Anne-Marie', 'annmarie.michelle@gemail.com', 'p@ssw0rd1dEux3', 'Femme', 'MzY0MTM5MC5wbmc='),
(1, 'Terrieur', 'Alain', 'alain.terrieur@yeahoo.fr', 'p@ssw0rd1dEux3', 'Homme', 'MDhmMGVjOWYzOGYzNzZkMzg0ZDlkZGFmZDNlNTc0ZDIuanBn');

INSERT INTO NEWS (id_club, titre_news, article_news) VALUES
(1, 'Le PSG en quête de son huitième titre consécutif', 'Le Paris Saint-Germain, qui domine la Ligue 1 depuis plusieurs saisons, est bien parti pour décrocher son huitième titre consécutif. Avec une attaque explosive menée par Kylian Mbappé et Neymar, le PSG impressionne. Cependant, des blessures récentes pourraient mettre en jeu la profondeur de leur effectif, offrant ainsi un espoir à leurs rivaux.');

INSERT INTO commentaire (id_news, id_uti, desc_com) VALUES
(1, 1, 'Le PSG semble inarrêtable dans sa quête du huitième titre consécutif en Ligue 1. Mbappé et Neymar sont en feu, mais les récentes blessures soulèvent des questions sur la solidité de leur effectif. La bataille pour le titre se montre plus intense que jamais cette saison.'),
(1, 2, 'La domination du PSG en Ligue 1 est indéniable, mais les blessures actuelles pourraient être un tournant. La profondeur de leur banc sera mise à en jeu, offrant aux rivaux une opportunité de combler la différence. Le suspense est à son comble, et la course au huitième titre consécutif semble pleine de rebondissements.'),
(1, 3, 'o skour mon pc marsh plu é g beso1 ded si kelk1 pouvé maidé mrc 2 me répondr');