/* testé sous mysql 5.x */

/*==============================================================*/
/* table : activite_compl                                     */
/*==============================================================*/
create table activite_compl 
(
   id_activite_compl  integer            not null       auto_increment,
   date_activite      date,
   lieu_activite      varchar(200),
   theme_activite     varchar(100),
   motif_activite     varchar(100),
   constraint pk_activite_compl primary key (id_activite_compl)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : composant                                          */
/*==============================================================*/
create table composant 
(
   id_composant       integer           not null       auto_increment,
   lib_composant      varchar(100),
   constraint pk_composant primary key (id_composant)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : constituer                                         */
/*==============================================================*/
create table constituer 
(
   id_composant       integer            not null,
   id_medicament      integer            not null,
   qte_composant      decimal(11,2),
   constraint pk_constituer primary key (id_composant, id_medicament)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : dosage                                             */
/*==============================================================*/
create table dosage 
(
   id_dosage          integer            not null       auto_increment,
   qte_dosage         integer,
   unite_dosage       char(10),
   constraint pk_dosage primary key (id_dosage)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : etat                                               */
/*==============================================================*/
create table etat 
(
   id_etat            integer            not null       auto_increment,
   lib_etat           varchar(120),
   constraint pk_etat primary key (id_etat)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : famille                                            */
/*==============================================================*/
create table famille 
(
   id_famille         integer            not null       auto_increment,
   lib_famille        varchar(100),
   constraint pk_famille primary key (id_famille)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : fichefrais                                         */
/*==============================================================*/
create table fichefrais 
(
   id_fiche_frais     integer            not null       auto_increment,
   id_etat            integer            not null,
   anneemois          char(6)              not null,
   id_visiteur        integer            not null,
   nb_justificatifs   integer,
   date_modification  date,
   montant_valide     decimal(10,2),
   constraint pk_fichefrais primary key (id_fiche_frais)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : formuler                                           */
/*==============================================================*/
create table formuler 
(
   id_medicament      integer            not null,
   id_presentation    integer            not null,
   constraint pk_formuler primary key (id_medicament, id_presentation)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : fraisforfait                                       */
/*==============================================================*/
create table fraisforfait 
(
   id_fraisforfait    integer            not null       auto_increment,
   lib_fraisforfait   varchar(100),
   montant_frais_forfait decimal(5,2),
   constraint pk_fraisforfait primary key (id_fraisforfait)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : fraishorsforfait                                   */
/*==============================================================*/
create table fraishorsforfait 
(
   id_fraishorsforfait integer            not null,
   id_fiche_frais     integer            not null,
   date_fraishorsforfait date,
   montant_fraishorsforfait decimal(10,2),
   lib_fraishorsforfait varchar(200),
   constraint pk_fraishorsforfait primary key (id_fraishorsforfait)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : interagir                                          */
/*==============================================================*/
create table interagir 
(
   id_medicament      integer            not null,
   med_id_medicament  integer            not null,
   constraint pk_interagir primary key (id_medicament, med_id_medicament)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : inviter                                            */
/*==============================================================*/
create table inviter 
(
   id_activite_compl  integer            not null,
   id_praticien       integer            not null,
   specialiste        char(1)              not null,
   constraint pk_inviter primary key (id_activite_compl, id_praticien)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : labo                                               */
/*==============================================================*/
create table laboratoire 
(
   id_laboratoire            integer            not null       auto_increment,
   nom_laboratoire           varchar(100),
   chef_vente         varchar(100),
   constraint pk_labo primary key (id_laboratoire)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : ligne_fraisforfait                                 */
/*==============================================================*/
create table ligne_fraisforfait 
(
   id_fiche_frais     integer            not null,
   id_fraisforfait    integer            not null,
   quantite_ligne     integer,
   constraint pk_ligne_fraisforfait primary key (id_fiche_frais, id_fraisforfait)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : medicament                                         */
/*==============================================================*/
create table medicament 
(
   id_medicament      integer            not null       auto_increment,
   id_famille         integer,
   depot_legal        varchar(100),
   nom_commercial     varchar(100),
   composition        char(255),
   effets             varchar(512),
   contre_indication  char(255),
   prix_echantillon   decimal(11,2),
   constraint pk_medicament primary key (id_medicament)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : offrir                                             */
/*==============================================================*/
create table offrir 
(
   id_medicament      integer            not null,
   id_rapport         integer            not null,
   id_visiteur        integer            not null,
   qte_offerte        integer,
   constraint pk_offrir primary key (id_medicament, id_rapport, id_visiteur)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : posseder                                           */
/*==============================================================*/
create table posseder 
(
   id_praticien       integer            not null,
   id_specialite      integer            not null,
   diplome            varchar(100),
   coef_prescription  decimal(11,2),
   constraint pk_posseder primary key (id_praticien, id_specialite)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : praticien                                          */
/*==============================================================*/
create table praticien 
(
   id_praticien       integer            not null       auto_increment,
   id_type_praticien  integer,
   nom_praticien      varchar(100),
   prenom_praticien   varchar(100),
   adresse_praticien  varchar(200),
   cp_praticien       char(5),
   ville_praticien    varchar(100),
   coef_notoriete     decimal(11,2),
   constraint pk_praticien primary key (id_praticien)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : prescrire                                          */
/*==============================================================*/
create table prescrire 
(
   id_dosage          integer            not null,
   id_medicament      integer            not null,
   id_type_individu   integer            not null,
   posologie          varchar(100),
   constraint pk_prescrire primary key (id_dosage, id_medicament, id_type_individu)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : presentation                                       */
/*==============================================================*/
create table presentation 
(
   id_presentation    integer            not null       auto_increment,
   lib_presentation   varchar(100),
   constraint pk_presentation primary key (id_presentation)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : rapport_visite                                     */
/*==============================================================*/
create table rapport_visite 
(
   id_rapport         integer            not null auto_increment,
   id_praticien       integer,
   id_visiteur        integer            not null,
   date_rapport       date,
   bilan              varchar(512),
   motif              varchar(255),
   constraint pk_rapport_visite primary key (id_rapport)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : realiser                                           */
/*==============================================================*/
create table realiser 
(
   id_activite_compl  integer            not null,
   id_visiteur        integer            not null,
   montant_ac         decimal(11,2),
   constraint pk_realiser primary key (id_activite_compl, id_visiteur)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : region                                             */
/*==============================================================*/
create table region 
(
   id_region          integer            not null       auto_increment,
   id_secteur         integer,
   nom_region         varchar(100),
   constraint pk_region primary key (id_region)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : secteur                                            */
/*==============================================================*/
create table secteur 
(
   id_secteur         integer            not null       auto_increment,
   lib_secteur        varchar(100),
   constraint pk_secteur primary key (id_secteur)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : specialite                                         */
/*==============================================================*/
create table specialite 
(
   id_specialite      integer            not null       auto_increment,
   lib_specialite     varchar(100),
   constraint pk_specialite primary key (id_specialite)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : travailler                                         */
/*==============================================================*/
create table travailler 
(
   id_visiteur        integer            not null,
   jjmmaa             date                 not null,
   id_region          integer            not null,
   role_visiteur      varchar(100),
   constraint pk_travailler primary key (id_visiteur, jjmmaa, id_region)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : type_individu                                      */
/*==============================================================*/
create table type_individu 
(
   id_type_individu   integer            not null       auto_increment,
   lib_type_individu  varchar(100),
   constraint pk_type_individu primary key (id_type_individu)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : type_praticien                                     */
/*==============================================================*/
create table type_praticien 
(
   id_type_praticien  integer            not null       auto_increment,
   lib_type_praticien varchar(100),
   lieu_type_praticien varchar(200),
   constraint pk_type_praticien primary key (id_type_praticien)
) engine=innodb character set utf8 collate utf8_general_ci;

/*==============================================================*/
/* table : visiteur                                           */
/*==============================================================*/
create table visiteur 
(
   id_visiteur        integer            not null       auto_increment,
   id_laboratoire     integer,
   id_secteur         integer,
   nom_visiteur       varchar(100),
   prenom_visiteur    varchar(100),
   adresse_visiteur   varchar(200),
   cp_visiteur        char(5),
   ville_visiteur     varchar(100),
   date_embauche      date,
   login_visiteur     varchar(50),
   pwd_visiteur       varchar(200),
   salt               varchar(23)                    not null,
   role               varchar(100)                   not null,
   type_visiteur      char(1),
   constraint uniq_login_visiteur unique key (login_visiteur),
   constraint pk_visiteur primary key (id_visiteur)
) engine=innodb character set utf8 collate utf8_general_ci;
