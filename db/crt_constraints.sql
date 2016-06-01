alter table constituer
   add constraint fk_constituer_composant foreign key (id_composant)
      references composant (id_composant);

alter table constituer
   add constraint fk_constituer_medicament foreign key (id_medicament)
      references medicament (id_medicament);

alter table fichefrais
   add constraint fk_fichefrais_etat foreign key (id_etat)
      references etat (id_etat);

alter table fichefrais
   add constraint fk_fichefrais_visiteur foreign key (id_visiteur)
      references visiteur (id_visiteur);

alter table formuler
   add constraint fk_formuler_presentation foreign key (id_presentation)
      references presentation (id_presentation);

alter table formuler
   add constraint fk_formuler_medicament foreign key (id_medicament)
      references medicament (id_medicament);

alter table fraishorsforfait
   add constraint fk_fraishorsforfait_fichefrais foreign key (id_fiche_frais)
      references fichefrais (id_fiche_frais);

alter table interagir
   add constraint fk_interagir_medicament foreign key (id_medicament)
      references medicament (id_medicament);

alter table interagir
   add constraint fk_interagir_medicament_dest foreign key (med_id_medicament)
      references medicament (id_medicament);

alter table inviter
   add constraint fk_inviter_activite_compl foreign key (id_activite_compl)
      references activite_compl (id_activite_compl);

alter table inviter
   add constraint fk_inviter_praticien foreign key (id_praticien)
      references praticien (id_praticien);

alter table ligne_fraisforfait
   add constraint fk_ligne_fichefrais foreign key (id_fiche_frais)
      references fichefrais (id_fiche_frais);

alter table ligne_fraisforfait
   add constraint fk_ligne_fraisforfait foreign key (id_fraisforfait)
      references fraisforfait (id_fraisforfait);

alter table medicament
   add constraint fk_medicament_famille foreign key (id_famille)
      references famille (id_famille);

alter table offrir
   add constraint fk_offrir_rapport_visite foreign key (id_rapport)
      references rapport_visite (id_rapport);

alter table offrir
   add constraint fk_offrir_visiteur foreign key (id_visiteur)
      references visiteur (id_visiteur);

alter table offrir
   add constraint fk_offrir_medicament foreign key (id_medicament)
      references medicament (id_medicament);

alter table posseder
   add constraint fk_posseder_praticien foreign key (id_praticien)
      references praticien (id_praticien);

alter table posseder
   add constraint fk_posseder_specialite foreign key (id_specialite)
      references specialite (id_specialite);

alter table praticien
   add constraint fk_praticien_type_praticien foreign key (id_type_praticien)
      references type_praticien (id_type_praticien);

alter table prescrire
   add constraint fk_prescrire_medicament foreign key (id_medicament)
      references medicament (id_medicament);

alter table prescrire
   add constraint fk_prescrire_type_individu foreign key (id_type_individu)
      references type_individu (id_type_individu);

alter table prescrire
   add constraint fk_prescrire_dosage foreign key (id_dosage)
      references dosage (id_dosage);

alter table rapport_visite
   add constraint fk_rapport_visite_praticien foreign key (id_praticien)
      references praticien (id_praticien);

alter table rapport_visite
   add constraint fk_rapport_visite_visiteur foreign key (id_visiteur)
      references visiteur (id_visiteur);

alter table realiser
   add constraint fk_realiser_activite_compl foreign key (id_activite_compl)
      references activite_compl (id_activite_compl);

alter table realiser
   add constraint fk_realiser_visiteur foreign key (id_visiteur)
      references visiteur (id_visiteur);

alter table region
   add constraint fk_region_secteur foreign key (id_secteur)
      references secteur (id_secteur);

alter table travailler
   add constraint fk_travailler_region foreign key (id_region)
      references region (id_region);

alter table travailler
   add constraint fk_travailler_visiteur foreign key (id_visiteur)
      references visiteur (id_visiteur);

alter table visiteur
   add constraint fk_visiteur_secteur foreign key (id_secteur)
      references secteur (id_secteur);

alter table visiteur
   add constraint fk_visiteur_laboratoire foreign key (id_laboratoire)
      references laboratoire (id_laboratoire);
