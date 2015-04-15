<?php

namespace STS\AnnuaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnuaireType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $departements = array(
            1 => "Ain",
            2 => "Aisne",
            3 => "Allier",
            5 => "Hautes-Alpes",
            4 => "Alpes-de-Haute-Provence",
            6 => "Alpes-Maritimes",
            7 => "Ardêche",
            8 => "Ardennes",
            9 => "Ariège",
            10 => "Aube",
            11 => "Aude",
            12 => "Aveyron",
            13 => "Bouches-du-Rhône",
            14 => "Calvados",
            15 => "Cantal",
            16 => "Charente",
            17 => "Charente-Maritime",
            18 => "Cher",
            19 => "Corrèze",
            "2A" => "Corse-du-Sud",
            "2B" => "Haute-Corse",
            21 => "Côte-d'Or",
            22 => "Côtes-d'Armor",
            23 => "Creuse",
            24 => "Dordogne",
            25 => "Doubs",
            26 => "Drôme",
            27 => "Eure",
            28 => "Eure-et-Loir",
            29 => "Finistère",
            30 => "Gard",
            31 => "Haute-Garonne",
            32 => "Gers",
            33 => "Gironde",
            34 => "Hérault",
            35 => "Ile-et-Vilaine",
            36 => "Indre",
            37 => "Indre-et-Loire",
            38 => "Isère",
            39 => "Jura",
            40 => "Landes",
            41 => "Loir-et-Cher",
            42 => "Loire",
            43 => "Haute-Loire",
            44 => "Loire-Atlantique",
            45 => "Loiret",
            46 => "Lot",
            47 => "Lot-et-Garonne",
            48 => "Lozère",
            49 => "Maine-et-Loire",
            50 => "Manche",
            51 => "Marne",
            52 => "Haute-Marne",
            53 => "Mayenne",
            54 => "Meurthe-et-Moselle",
            55 => "Meuse",
            56 => "Morbihan",
            57 => "Moselle",
            58 => "Nièvre",
            59 => "Nord",
            60 => "Oise",
            61 => "Orne",
            62 => "Pas-de-Calais",
            63 => "Puy-de-Dôme",
            64 => "Pyrénées-Atlantiques",
            65 => "Pyrénées-Orientales",
            67 => "Bas-Rhin",
            68 => "Haut-Rhin",
            69 => "Rhône",
            70 => "Haute-Saône",
            71 => "Saône-et-Loire",
            72 => "Sarthe",
            73 => "Savoie",
            74 => "Haute-Savoie",
            75 => "Paris",
            76 => "Seine-Maritime",
            77 => "Seine-et-Marne",
            78 => "Yvelines",
            79 => "Deux-Sèvres",
            80 => "Somme",
            81 => "Tarn",
            82 => "Tarn-et-Garonne",
            83 => "Var",
            84 => "Vaucluse",
            85 => "Vendée",
            86 => "Vienne",
            87 => "Haute-Vienne",
            88 => "Vosges",
            89 => "Yonne",
            90 => "Territoire de Belfort",
            91 => "Essonne",
            92 => "Hauts-de-Seine",
            93 => "Seine-Saint-Denis",
            94 => "Val-de-Marne",
            95 => "Val-d'Oise",
            976 => "Mayotte",
            971 => "Guadeloupe",
            973 => "Guyane",
            972 => "Martinique",
            974 => "Réunion",
        );



// construction du formulaire
        $builder
                ->add('nom', 'text', array(
                    'attr' => array(
                        'size' => 50,
                        'pattern' => "\D{1,}",
                        'placeholder' => 'Entrez un nom'),
                    'label' => 'Nom'))
                ->add('prenom', 'text', array(
                    'attr' => array(
                        'size' => 50,
                        'pattern' => "\D{1,}",
                        'placeholder' => 'Entrez un prénom'),
                    'label' => 'Prénom'))
                ->add('telFixe', 'text', array(
                    'attr' => array(
                        'size' => 12,
                        'placeholder' => 'Téléphone',
                        'pattern' => "^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$"),
                    'label' => 'Téléphone'))
                ->add('telMobile', 'text', array(
                    'attr' => array(
                        'size' => 12,
                        'placeholder' => 'Mobile',
                        'pattern' => "^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$"),
                    'label' => 'Mobile'))
                ->add('departement', 'choice', array(
                    'choices' => $departements,
                    'preferred_choices' => array(),
                    'multiple' => false,
                    'empty_data' => -1,
                    'label' => 'Département',
                    'empty_value' => '- Choisissez une option -')
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'STS\AnnuaireBundle\Entity\Annuaire'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'sts_annuairebundle_annuaire';
    }

}
