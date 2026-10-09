/**
 * ATS TEKNO - MULTILINGUAL TRANSLATION ENGINE (EN & FR)
 * Exclusively for /panel-building-process
 * Seamlessly translates 33 steps, machines, headers, and UI labels
 */

(function() {
    'use strict';

    const FR_MACHINES = [
    {
        "title": "Système de Découpe Laser Fibre CNC",
        "desc": "Équipé de résonateurs laser fibre de 1 500 W et 1 000 W, de tables d'échange automatique à double navette et d'une collimation optique de haute précision. Assure des découpes au sous-millimètre avec une zone affectée thermiquement minimale pour l'acier doux, la tôle galvanisée et l'acier inoxydable.",
        "tags": [
            "Résonateurs 1 500 W & 1 000 W",
            "Tolérance de Découpe ±0,05 mm",
            "Table d'Échange Double Navette",
            "Imbrication CAO Automatisée"
        ]
    },
    {
        "title": "Presse Plieuse Hydraulique Multi-Axes CNC",
        "desc": "Système de pliage synchronisé à commande numérique Delem avec butée arrière multi-axes et compensation de bombage hydraulique. Assure des angles de pliage parfaits et des tolérances constantes sur les armoires jusqu'à 3 200 mm de longueur.",
        "tags": [
            "Capacité de Pliage 160 Tonnes",
            "Contrôleur CNC Multi-Axes",
            "Compensation de Bombage Précise",
            "Longueurs de Pliage jusqu'à 3,2 m"
        ]
    },
    {
        "title": "Poinçonneuse Tourelle CNC",
        "desc": "Poinçonneuse à tourelle à haute cadence pour le poinçonnage rapide de perforations, persiennes d'aération, emboutis et découpes de connecteurs d'appareillage dans la tôle avant pliage.",
        "tags": [
            "Tourelle Multi-Outils",
            "Frappes Haute Cadence",
            "Outils de Persiennes & Emboutis",
            "Tolérance Répétable de ±0,1 mm"
        ]
    },
    {
        "title": "Cisaille Guillotine Hydraulique Industrielle",
        "desc": "Cisaille guillotine industrielle pour la découpe de tôles jusqu'à 6 mm d'épaisseur. Équipée d'un réglage hydraulique de l'écartement des lames et d'une butée arrière motorisée pour des chants nets sans bavures.",
        "tags": [
            "Capacité de Coupe Épaisseur 6 mm",
            "Écartement de Lame Hydraulique",
            "Coupe Nette sans Déformation",
            "Capacité Longueur 3 200 mm"
        ]
    },
    {
        "title": "Décapage Chimique à l'Acide & Dégraissage",
        "desc": "Bains d'immersion chimique à l'acide chlorhydrique (HCl) pour éliminer totalement la calamine, les oxydes et la rouille. Étape indispensable pour garantir l'adhérence maximale et la longévité de la peinture.",
        "tags": [
            "Élimination Chimique de la Calamine",
            "Bains à Immersion Contrôlée",
            "Préparation de Surface Idéale",
            "Normes Environnementales Respectées"
        ]
    },
    {
        "title": "Bains de Phosphatation Chimique & Neutralisation",
        "desc": "Traitement de phosphatation par conversion chimique créant une couche protectrice microcristalline anticorrosion de phosphate de fer ou de zinc, suivie d'un rinçage et d'une neutralisation rigoureuse.",
        "tags": [
            "Couche de Conversion Anticorrosion",
            "Bain de Neutralisation & Rinçage",
            "Adhérence Poudre Optimisée",
            "Protection Longue Durée"
        ]
    },
    {
        "title": "Thermolaquage Électrostatique & Four de Cuisson",
        "desc": "Cabines d'application électrostatique de poudre polyester pure avec four de polymérisation à haute température (180°C - 200°C). Finition résistante aux chocs, UV et environnements industriels sévères.",
        "tags": [
            "Poudre Polyester Pure Industrial",
            "Cuisson Régulée 180°C - 200°C",
            "Épaisseur de Film 70 - 90 µm",
            "Finition Sans Défaut"
        ]
    },
    {
        "title": "Équipement d'Appareillage & Câblage de Tableaux",
        "desc": "Atelier dédié à l'assemblage mécanique, à la confection et au cintrage de jeux de barres en cuivre électrolytique (jusqu'à 4 000 A+), au câblage de commande et de puissance et aux tests FAT.",
        "tags": [
            "Jeux de Barres Cuivre jusqu'à 4 000 A+",
            "Câblage Conforme CEI 61439",
            "Repérage & Numérotation Rigueur",
            "Poste de Tests FAT Dédié"
        ]
    }
];
    const FR_PHASES = [
    {
        "title": "Ingénierie",
        "caption": "Spécifications techniques traduites en plans d'atelier validés.",
        "desc": "Collecte des besoins, schémas CAO, validation client et planification de fabrication."
    },
    {
        "title": "Tôlerie & Fabrication",
        "caption": "Découpe, pliage et soudure de précision pour châssis et enveloppes.",
        "desc": "Découpe laser CNC, poinçonnage, pliage et soudage certifié."
    },
    {
        "title": "Traitement de Surface",
        "caption": "Préparation chimique multi-bains pour une résistance anticorrosion totale.",
        "desc": "Dégraissage, décapage acide, neutralisation et phosphatation de conversion."
    },
    {
        "title": "Thermolaquage",
        "caption": "Application électrostatique et polymérisation au four pour finition haute durabilité.",
        "desc": "Revêtement poudre polyester et cuisson au four régulé."
    },
    {
        "title": "Montage & Câblage",
        "caption": "Intégration d'appareillage, façonnage des barres de cuivre et câblage soigné.",
        "desc": "Assemblage mécanique, jeux de barres, composants électriques et filerie."
    },
    {
        "title": "Qualité & Expédition",
        "caption": "Essais FAT rigoureux, vérification diélectrique et emballage export sécurisé.",
        "desc": "Essais diélectriques, tests fonctionnels, contrôle qualité final et expédition."
    }
];
    const FR_STEPS = [
    {
        "title": "Spécifications Techniques & Besoins Client",
        "subtitle": "Compréhension de Vos Exigences Techniques",
        "description": "Les contraintes d'exploitation et spécifications techniques sont recueillies comme base de conception du tableau. Le périmètre du projet est clairement fixé avant le début des études.",
        "activities": [
            "Identifier les fonctionnalités opérationnelles et les puissances de charge électrique",
            "Recueillir les schémas unifilaires (SLD), cahiers des charges et contraintes d'installation",
            "Définir le périmètre de fourniture, les matériaux d'enveloppe et la documentation requise"
        ],
        "checkpoint": "Complétude des données et alignement signé du périmètre technique.",
        "output": "Dossier de spécifications techniques approuvé servant de base d'ingénierie."
    },
    {
        "title": "Ingénierie & Conception CAO / AutoCAD",
        "subtitle": "Schématisation Électrique & Conception Mécanique",
        "description": "Les ingénieurs conçoivent les schémas unifilaires détaillés, l'implantation mécanique des composants, les circuits de commande et l'agencement du jeu de barres en conformité avec la norme CEI 61439.",
        "activities": [
            "Concevoir les schémas de puissance, schémas de commande et borniers sous AutoCAD",
            "Dimensionner les calibres de disjoncteurs, sections de barres et tenue aux courts-circuits",
            "Modéliser l'enveloppe en 3D avec les passages de câbles et les dégagements thermiques"
        ],
        "checkpoint": "Vérification des calculs de court-circuit et des distances d'isolement selon CEI 61439.",
        "output": "Dossier de plans d'approbation et schémas électriques détaillés."
    },
    {
        "title": "Revue d'Ingénierie Interne",
        "subtitle": "Contrôle Qualité de la Conception & Faisabilité",
        "description": "Une revue technique croisée entre ingénieurs d'études et responsables d'atelier garantit la conformité normative, la fabricabilité mécanique et la sécurité électrique.",
        "activities": [
            "Vérifier la sélection des composants, calibres et plages de déclenchement",
            "Contrôler les espacements mécaniques, la dissipation thermique et l'indice de protection IP",
            "Valider les contraintes de fabrication tôlerie, de pliage et de cheminement de câbles"
        ],
        "checkpoint": "Validation formelle par l'ingénieur en chef d'atelier.",
        "output": "Plans d'atelier validés prêts pour la soumission au client."
    },
    {
        "title": "Revue Client & Approbation des Plans",
        "subtitle": "Validation Définitive Avant Lancement en Production",
        "description": "Les plans d'implantation, schémas électriques et nomenclatures de matériel sont soumis au client ou à son bureau d'études pour revue et signature d'approbation (Approved for Construction).",
        "activities": [
            "Présenter les plans au client et clarifier les choix techniques",
            "Intégrer les éventuels commentaires ou ajustements demandés",
            "Obtenir la signature d'approbation formelle pour mise en production"
        ],
        "checkpoint": "Signature formelle d'approbation (AFC / Bon pour Exécution).",
        "output": "Dossier de fabrication approuvé débloquant les approvisionnements."
    },
    {
        "title": "Planification & Préparation des Matières",
        "subtitle": "Approvisionnement & Contrôle Qualité Réception",
        "description": "Les tôles d'acier certifiées (SPHC / électrozinguées), les barres de cuivre électrolytique et l'appareillage électrique sont réservés et inspectés avant usinage.",
        "activities": [
            "Vérifier les certificats matière des tôles d'acier et des barres de cuivre",
            "Inspecter l'état de surface, l'épaisseur des tôles et la conformité dimensionnelle",
            "Éditer les ordres de fabrication atelier et préparer les lots de production"
        ],
        "checkpoint": "Conformité des certificats matière et tolérances d'épaisseur.",
        "output": "Matières premières certifiées prêtes pour l'atelier de tôlerie."
    },
    {
        "title": "Programmation CNC & Imbrication (Nesting)",
        "subtitle": "Optimisation des Découpes & Fichiers Machines",
        "description": "Les fichiers CAO 3D sont développés à plat et traités par logiciel d'imbrication automatique pour maximiser l'utilisation de la matière et générer les programmes CNC (code G).",
        "activities": [
            "Calculer les développés de tôle avec les facteurs K et pertes de pliage réels",
            "Imbriquer les pièces sur les formats de tôle pour réduire les chutes",
            "Générer et simuler les parcours d'outils CNC laser et poinçonnage"
        ],
        "checkpoint": "Validation de l'imbrication et simulation sans collision.",
        "output": "Programmes CNC prêts pour le chargement sur machine."
    },
    {
        "title": "Découpe Laser CNC & Poinçonnage",
        "subtitle": "Usinage Haute Précision des Tôles d'Enveloppe",
        "description": "Les lasers fibre et poinçonneuses découpent les tôles avec une tolérance stricte de ±0,05 mm, en réalisant les perçages d'appareillage, fenêtres de mesure et ouïes d'aération.",
        "activities": [
            "Découper au laser fibre les portes, parois, plastrons et châssis",
            "Poinçonner les persiennes de ventilation et les formes spécifiques",
            "Vérifier la précision des premières pièces sur gabarit de contrôle"
        ],
        "checkpoint": "Contrôle dimensionnel au pied à coulisse et équerrage.",
        "output": "Tôles découpées précises prêtes pour l'ébarbage."
    },
    {
        "title": "Ébavurage & Finition des Chants",
        "subtitle": "Suppression des Bavures & Adoucissement des Arêtes",
        "description": "Toutes les arêtes découpées et perçages sont ébavurés mécaniquement afin d'éliminer les bavures tranchantes et prévenir tout risque de détérioration des câbles.",
        "activities": [
            "Ébavurer mécaniquement les chants vifs et perforations",
            "Arrondir légèrement les angles pour une adhérence optimale de la peinture",
            "Dépoussiérer les pièces avant l'opération de pliage"
        ],
        "checkpoint": "Absence totale de bavures coupantes au contrôle tactile.",
        "output": "Pièces ébavurées et sécurisées prêtes pour le formage."
    },
    {
        "title": "Pliage & Formage CNC",
        "subtitle": "Pliage Haute Précision sur Presse Plieuse",
        "description": "Les pièces sont pliées sur presse plieuse hydraulique CNC multi-axes avec compensation de bombage pour obtenir des profilés rigides et des angles parfaits.",
        "activities": [
            "Régler les butées CNC et le jeu d'outils (vé et poinçon)",
            "Plier les châssis, montants, portes et tôles de fond avec contrôle d'angle",
            "Vérifier les dimensions fonctionnelles et les rayons de courbure"
        ],
        "checkpoint": "Contrôle des angles au rapporteur de précision (tolérance ±0,5°).",
        "output": "Composants pliés conformes aux cotes d'assemblage."
    },
    {
        "title": "Ajustage & Contrôle Dimensionnel",
        "subtitle": "Prémontage à Blanc de la Structure d'Armoire",
        "description": "Les éléments pliés sont pré-assemblés à blanc sur marbre de contrôle pour vérifier l'équerrage, la planéité et le bon alignement des portes et serrures avant soudure.",
        "activities": [
            "Assembler à blanc les montants de structure et panneaux",
            "Vérifier les diagonales et l'alignement des jeux de portes",
            "Ajuster les jeux fonctionnels et positions des charnières"
        ],
        "checkpoint": "Tolérance diagonale inférieure à 1,5 mm sur la hauteur totale.",
        "output": "Ensemble ajusté et bridé prêt pour le soudage."
    },
    {
        "title": "Soudage de Structure (TIG / MIG / Par Points)",
        "subtitle": "Assemblage Mécanique Rigide & Étanche",
        "description": "Soudage certifié des armatures, renforts et goujons de mise à la terre selon les normes de résistance mécanique requises pour tableaux de distribution lourds.",
        "activities": [
            "Souder la structure sous protection gazeuse (MIG/TIG)",
            "Souder par décharge de condensateur les goujons filetés de masse",
            "Vérifier l'absence de déformation thermique et la solidité des cordons"
        ],
        "checkpoint": "Contrôle visuel des cordons et test de résistance mécanique.",
        "output": "Structure d'armoire rigide et entièrement assemblée."
    },
    {
        "title": "Meulage & Finition de Surface",
        "subtitle": "Préparation Esthétique des Soudures",
        "description": "Les cordons de soudure sont arasés et meulés avec soin pour obtenir des surfaces parfaitement lisses et planes avant traitement de surface chimique.",
        "activities": [
            "Meuler et surfacer les cordons de soudure extérieurs",
            "Éliminer les grattons de soudure et les aspérités métalliques",
            "Effectuer un ponçage de finition sur les zones visibles"
        ],
        "checkpoint": "Surfaces planes et sans aspérité au contrôle visuel et tactile.",
        "output": "Armoire prête pour le cycle de traitement chimique."
    },
    {
        "title": "Dégraissage & Nettoyage Chimique",
        "subtitle": "Bain de Dégraissage Alcalin Éliminant Huiles et Graisses",
        "description": "Immersion des pièces dans un bain dégraissant alcalin chauffé pour éliminer les huiles de laminage, fluides de coupe et traces grasses.",
        "activities": [
            "Immerger les pièces dans le bain de dégraissage alcalin",
            "Surveiller la température et le temps de contact optimal",
            "Égoutter les pièces avant le transfert au bain suivant"
        ],
        "checkpoint": "Test de film d'eau continu sans rupture (absence d'huile résiduelle).",
        "output": "Surfaces métalliques parfaitement dégraissées."
    },
    {
        "title": "Décapage Chimique (Bain d'Acide HCl)",
        "subtitle": "Élimination Complète de la Rouille et de la Calamine",
        "description": "Immersion contrôlée dans un bain d'acide chlorhydrique pour dissoudre la calamine d'usine et la rouille superficielle, mettant le métal à nu.",
        "activities": [
            "Immerger les pièces dans la solution d'acide chlorhydrique",
            "Contrôler la concentration d'acide et le temps d'attaque",
            "Contrôler la désoxydation complète des recoins et soudures"
        ],
        "checkpoint": "Métal blanc propre sans trace de calamine ou rouille.",
        "output": "Acier décapé chimiquement prêt pour neutralisation."
    },
    {
        "title": "Rinçage à l'Eau Claire",
        "subtitle": "Élimination des Résidus d'Acide de Surface",
        "description": "Rinçage rigoureux par aspersion et immersion dans de l'eau claire pour éliminer toute trace d'acide avant le bain de neutralisation.",
        "activities": [
            "Rincer par immersion et aspersion sous pression",
            "Contrôler le renouvellement de l'eau de rinçage",
            "Éviter le piégeage de liquide dans les corps creux"
        ],
        "checkpoint": "Contrôle du pH de l'eau d'égouttage.",
        "output": "Pièces rincées prêtes pour la neutralisation."
    },
    {
        "title": "Neutralisation Chimique",
        "subtitle": "Stabilisation du pH et Neutralisation de l'Acidité",
        "description": "Immersion dans un bain neutralisant pour stabiliser la surface métallique et neutraliser tout résidu acide restant dans les porosités.",
        "activities": [
            "Immerger dans la solution de neutralisation alcaline",
            "Stabiliser la chimie de surface du métal",
            "Égoutter minutieusement les pièces"
        ],
        "checkpoint": "Surface neutre (pH vérifié entre 7 et 8).",
        "output": "Surfaces métalliques neutralisées prêtes pour phosphatation."
    },
    {
        "title": "Bain de Phosphatation Chimique",
        "subtitle": "Formation de la Couche de Conversion Anticorrosion",
        "description": "Immersion dans un bain de phosphatation qui crée une couche microcristalline assurant une résistance maximale à la corrosion et une excellente adhérence de la peinture.",
        "activities": [
            "Immerger dans la solution de phosphatation",
            "Contrôler le temps de séjour pour un dépôt microcristallin homogène",
            "Vérifier la régularité de la teinte grise caractéristique"
        ],
        "checkpoint": "Aspect gris uniforme attestant de la couche de phosphate formée.",
        "output": "Couche de protection anticorrosion déposée avec succès."
    },
    {
        "title": "Rinçage Final & Égouttage",
        "subtitle": "Rinçage de Finition sans Sels Résiduels",
        "description": "Dernier rinçage à l'eau déminéralisée pour éliminer les sels libres avant le séchage au four thermique.",
        "activities": [
            "Rincer les pièces à l'eau claire désionisée",
            "Égoutter les profilés et cavités",
            "Préparer l'enfournement pour séchage thermique"
        ],
        "checkpoint": "Absence totale de dépôts salins ou résidus liquides.",
        "output": "Pièces rincées prêtes pour le séchage au four."
    },
    {
        "title": "Séchage Thermique au Four",
        "subtitle": "Élimination Totale de l'Humidité Résiduelle",
        "description": "Chauffage dans le four de séchage à 100°C - 120°C pour évaporer toute trace d'humidité avant l'application de la poudre électrostatique.",
        "activities": [
            "Chauffer les pièces dans le four de séchage régulé",
            "Évacuer l'humidité des replis et zones fermées",
            "Refroidir les pièces à température ambiante avant poudrage"
        ],
        "checkpoint": "Pièces 100% sèches sans condensation résiduelle.",
        "output": "Surfaces sèches et prêtes pour l'application de peinture poudre."
    },
    {
        "title": "Application de Peinture Poudre Électrostatique",
        "subtitle": "Revêtement Poudre Polyester Haute Performance",
        "description": "Application électrostatique robotisée et manuelle de poudre polyester pure (teinte standard RAL 7035 ou personnalisée) avec épaisseur contrôlée.",
        "activities": [
            "Appliquer la poudre électrostatique au pistolet automatisé",
            "Couvrir soigneusement les chants, recoins et faces intérieures",
            "Contrôler l'homogénéité du poudrage avant enfournement"
        ],
        "checkpoint": "Couverture uniforme sans zones ombrées ni surépaisseurs.",
        "output": "Pièces poudrées prêtes pour polymérisation au four."
    },
    {
        "title": "Polymérisation & Cuisson au Four",
        "subtitle": "Cuisson Haute Température (180°C - 200°C)",
        "description": "Cuisson dans un four industriel régulé à 180°C - 200°C pendant 20 minutes pour fondre, réticuler et polymériser la résine en un film continu ultra-résistant.",
        "activities": [
            "Enfourner les pièces selon la courbe de température programmée",
            "Maintenir le palier de cuisson prescrit par le fabricant de poudre",
            "Refroidir progressivement pour éviter les chocs thermiques"
        ],
        "checkpoint": "Enregistrement de la courbe de température et temps de maintien.",
        "output": "Revêtement thermolaqué polymérisé et durci à cœur."
    },
    {
        "title": "Contrôle Qualité du Revêtement",
        "subtitle": "Mesure d'Épaisseur, Brillance & Test d'Adhérence",
        "description": "Mesure au micromètre électromagnétique de l'épaisseur du film sec (70 - 90 µm), test de quadrillage (adhérence ISO 2409) et inspection visuelle de l'aspect.",
        "activities": [
            "Mesurer l'épaisseur de peinture en plusieurs points clés",
            "Réaliser le test d'adhérence par quadrillage sur coupon témoin",
            "Inspecter la régularité de la teinte RAL et l'absence de piqûres"
        ],
        "checkpoint": "Épaisseur conforme 70-90 µm et adhérence classe 0 (norme ISO).",
        "output": "Rapport de contrôle peinture validé, pièces prêtes au montage."
    },
    {
        "title": "Montage Mécanique de l'Armoire",
        "subtitle": "Assemblage des Châssis, Panneaux, Portes et Joints",
        "description": "Montage de la structure mécanique avec visserie zinguée/inox, installation des joints d'étanchéité en mousse polyuréthane (étanchéité IP54/IP55/IP65) et des serrures.",
        "activities": [
            "Assembler les montants de structure et rails de montage",
            "Poser les joints d'étanchéité périphériques sur les portes",
            "Installer les serrures crémone, poignées et charnières robustes"
        ],
        "checkpoint": "Fermeture fluide des portes et compression uniforme des joints IP.",
        "output": "Enveloppe mécanique complète prête pour l'équipement électrique."
    },
    {
        "title": "Installation de l'Appareillage Électrique",
        "subtitle": "Implantation des Disjoncteurs, Contacteurs & Relais",
        "description": "Montage des disjoncteurs principaux (ACB / MCCB), contacteurs, départs moteurs, variateurs et relais de protection selon le plan d'implantation approuvé.",
        "activities": [
            "Fixer les disjoncteurs principaux et modulaires sur leurs châssis",
            "Installer les transformateurs de courant (TI), parafoudres et centrales de mesure",
            "Vérifier les couples de serrage mécanique des fixations"
        ],
        "checkpoint": "Conformité d'implantation avec le plan approuvé et repérage matériel.",
        "output": "Appareillage électrique en place prêt pour le raccordement."
    },
    {
        "title": "Fabrication & Raccordement du Jeu de Barres",
        "subtitle": "Cisaille, Pliage & Serrage au Couple du Cuivre",
        "description": "Usinage sur machine hydraulique des barres de cuivre électrolytique (pureté > 99,9%), pliage précis, perçage et montage sur isolateurs avec serrage dynamométrique étalonné.",
        "activities": [
            "Cisailler et poinçonner les barres de cuivre cuivre électrolytique",
            "Plier les barres selon le tracé 3D pour respecter les distances d'isolement",
            "Serrer la boulonnerie au couple dynamométrique avec marquage témoin de couple"
        ],
        "checkpoint": "Vérification des couples de serrage et pose du vernis témoin rouge.",
        "output": "Jeu de barres de puissance certifié jusqu'à 4 000 A+."
    },
    {
        "title": "Câblage de Commande & Puissance",
        "subtitle": "Cheminement Rigoureux, Filerie & Raccordements",
        "description": "Câblage des circuits de commande, signalisation, automatismes et puissance avec conducteurs cuivre souples de qualité, embouts sertis et cheminement en goulottes ajourées.",
        "activities": [
            "Passer les conducteurs de commande dans les goulottes industrielles",
            "Sertir les embouts de câblage isolés avec pinces étalonnées",
            "Raccorder les borniers de puissance et bornes de télécommande"
        ],
        "checkpoint": "Contrôle visuel du sertissage et vérification des serrages aux bornes.",
        "output": "Câblage complet, ordonné et parfaitement repéré."
    },
    {
        "title": "Repérage & Identification Industrielle",
        "subtitle": "Étiquetage Réglementaire de Tous les Circuits",
        "description": "Pose des repères de fils thermorétractables imprimés, étiquettes gravées des appareils, plaques signalétiques de portes et étiquettes de danger électrique normalisées.",
        "activities": [
            "Poser les repères de fils conformes aux numéros de schémas",
            "Fixer les étiquettes gravées sur les plastrons et portes d'armoire",
            "Poser la plaque signalétique principale et les étiquettes de consignation"
        ],
        "checkpoint": "Conformité à 100% entre les numéros de fils et le schéma électrique.",
        "output": "Tableau entièrement repéré et documenté."
    },
    {
        "title": "Contrôle Visuel & Mécanique",
        "subtitle": "Inspection Approfondie Avant Essais Sous Tension",
        "description": "Vérification minutieuse de l'absence de corps étrangers (chutes de fil, rondelles), du bon serrage de toutes les connexions et de la continuité des masses métalliques.",
        "activities": [
            "Vérifier la continuité de terre entre portes, châssis et barre principale",
            "Contrôler le couple de serrage de toutes les connexions de puissance",
            "Dépoussiérer l'intérieur de l'armoire par aspiration industrielle"
        ],
        "checkpoint": "Résistance de continuité des masses < 0,1 Ohm selon CEI 61439.",
        "output": "Tableau validé pour le démarrage des essais électriques."
    },
    {
        "title": "Essais Diélectriques & Rigidité Électrique",
        "subtitle": "Mesure d'Isolement & Essai Diélectrique Haute Tension",
        "description": "Essais normatifs selon CEI 61439 : mesure de résistance d'isolement sous 1 000 V continu et test de tenue diélectrique à 2 500 V alternatif pour garantir la sécurité des personnes.",
        "activities": [
            "Mesurer l'isolement entre phases et entre phases et terre (> 100 MOhm)",
            "Appliquer la tension d'épreuve diélectrique pendant 1 minute sans claquage",
            "Consigner les valeurs mesurées dans le procès-verbal d'essais"
        ],
        "checkpoint": "Tenue diélectrique validée sans amorçage ni courant de fuite excessif.",
        "output": "Rapport d'essais diélectriques officiel signé par l'ingénieur QC."
    },
    {
        "title": "Essais Fonctionnels & Automatisme (FAT)",
        "subtitle": "Test Opérationnel Complet en Présence du Client",
        "description": "Simulation sous tension des séquences de commande, verrouillages mécaniques et électriques, transferts automatiques de source (inverseur ATS) et déclenchements de disjoncteurs.",
        "activities": [
            "Tester les logiques de commande, automatismes et relais de protection",
            "Vérifier le fonctionnement des voyants, centrales de mesure et boutons-poussoirs",
            "Valider les scénarios de secours et verrouillages de sécurité"
        ],
        "checkpoint": "100% des séquences fonctionnelles validées par le client.",
        "output": "Procès-verbal de recette en usine (FAT) contresigné par le client."
    },
    {
        "title": "Nettoyage Final & Constitution du Dossier",
        "subtitle": "Dépoussiérage Minutieux & Documentation As-Built",
        "description": "Nettoyage intérieur et extérieur de l'armoire, pose de sachets déshydratants, insertion du jeu complet de schémas électriques finaux (As-Built) dans la pochette de porte.",
        "activities": [
            "Nettoyer soigneusement les parois et vitres de mesure",
            "Placer la documentation technique et les certificats dans la pochette de porte",
            "Insérer les sachets de gel de silice pour absorber l'humidité"
        ],
        "checkpoint": "Présence du dossier d'exploitation complet et propreté irréprochable.",
        "output": "Armoire prête pour l'emballage de protection."
    },
    {
        "title": "Emballage de Protection & Caisse Export",
        "subtitle": "Emballage Sous Film Bulle, Palette & Caisse en Bois",
        "description": "Protection intégrale sous film étirable et film bulles renforcé, fixation sur palette lourde cerclée et mise en caisse en bois traitée ISPM-15 pour transport maritime et export.",
        "activities": [
            "Envelopper l'armoire sous film plastique étanche et housse à bulles",
            "Fixer solidement l'armoire sur palette bois renforcée",
            "Fabriquer la caisse en bois traitée NIMP 15 avec étiquetage de manutention"
        ],
        "checkpoint": "Solidité de l'arrimage et conformité de la caisse pour l'exportation.",
        "output": "Colis sécurisé et étiqueté prêt pour l'expédition."
    },
    {
        "title": "Prêt pour Expédition & Livraison sur Site",
        "subtitle": "Chargement Sécurisé & Expédition Nationale ou Export",
        "description": "Vérification des bordereaux de livraison, formalités de transport et chargement sécurisé par chariot élévateur pour expédition sur site ou vers le port de fret.",
        "activities": [
            "Contrôler les documents de transport, packing list et certificats",
            "Charger avec précaution sur camion ou conteneur maritime",
            "Transmettre le suivi d'expédition et les instructions de déchargement au client"
        ],
        "checkpoint": "Bordereau de livraison émargé et confirmation de départ.",
        "output": "Livraison sécurisée sur le site du projet ou à destination internationale."
    }
];

    // Cache original English texts from DOM
    let enCached = false;
    const EN_CACHE = {
        machines: [],
        steps: [],
        phases: []
    };

    function cacheEnglish() {
        if (enCached) return;

        // Cache machines
        document.querySelectorAll('.eq-panel-slide').forEach((slide, idx) => {
            const nameEl = document.querySelectorAll('.eq-tab-name')[idx];
            const metaEl = document.querySelectorAll('.eq-tab-meta')[idx];
            const tags = Array.from(slide.querySelectorAll('.eq-tags li')).map(li => li.innerText.trim());
            EN_CACHE.machines.push({
                title: nameEl ? nameEl.innerText.trim() : '',
                tags: tags
            });
        });

        // Cache steps
        document.querySelectorAll('.p33-card').forEach((card, idx) => {
            const subtitleEl = card.querySelector('.p33-step-subtitle');
            const titleEl = card.querySelector('.p33-step-title');
            const descEl = card.querySelector('.p33-step-desc');
            const actEls = Array.from(card.querySelectorAll('.p33-act-list li span'));
            const checkEl = card.querySelector('.p33-checkpoint-box .p33-box-text');
            const outEl = card.querySelector('.p33-output-box .p33-box-text');
            
            EN_CACHE.steps.push({
                subtitle: subtitleEl ? subtitleEl.innerText.trim() : '',
                title: titleEl ? titleEl.innerText.trim() : '',
                desc: descEl ? descEl.innerText.trim() : '',
                activities: actEls.map(a => a.innerText.trim()),
                checkpoint: checkEl ? checkEl.innerText.trim() : '',
                output: outEl ? outEl.innerText.trim() : ''
            });
        });

        // Cache phases
        document.querySelectorAll('.p33-tab[data-phase-filter]:not([data-phase-filter="all"])').forEach((tab, idx) => {
            const span = tab.querySelector('span:first-child');
            EN_CACHE.phases.push(span ? span.innerText.trim() : '');
        });

        enCached = true;
    }

    function applyFrench() {
        cacheEnglish();

        // 1. Search Input Placeholder
        const searchInput = document.getElementById('p33-search-input');
        if (searchInput) {
            searchInput.placeholder = "Rechercher une étape (ex. laser, pliage, thermolaquage, jeux de barres, FAT)...";
        }

        // 2. Machine Specs & Tabs
        FR_MACHINES.forEach((m, idx) => {
            const nameEl = document.querySelectorAll('.eq-tab-name')[idx];
            if (nameEl) nameEl.textContent = m.title;

            const slide = document.querySelector(`.eq-panel-slide[data-panel-index="${idx}"]`);
            if (slide && m.tags) {
                const lis = slide.querySelectorAll('.eq-tags li');
                m.tags.forEach((tag, tIdx) => {
                    if (lis[tIdx]) {
                        const svg = lis[tIdx].querySelector('svg');
                        lis[tIdx].innerHTML = '';
                        if (svg) lis[tIdx].appendChild(svg);
                        lis[tIdx].appendChild(document.createTextNode(' ' + tag));
                    }
                });
            }
        });

        // 3. Phase Tabs
        FR_PHASES.forEach((p, idx) => {
            const tab = document.querySelector(`.p33-tab[data-phase-filter="${idx}"] span:first-child`);
            if (tab) {
                tab.textContent = `${String(idx + 1).padStart(2, '0')}. ${p.title}`;
            }
        });

        // 4. Process Cards
        document.querySelectorAll('.p33-card').forEach((card, idx) => {
            const fr = FR_STEPS[idx];
            if (!fr) return;

            const subtitleEl = card.querySelector('.p33-step-subtitle');
            if (subtitleEl && fr.subtitle) subtitleEl.textContent = fr.subtitle;

            const titleEl = card.querySelector('.p33-step-title');
            if (titleEl && fr.title) titleEl.textContent = fr.title;

            const descEl = card.querySelector('.p33-step-desc');
            if (descEl && fr.description) descEl.textContent = fr.description;

            if (fr.activities) {
                const actSpans = card.querySelectorAll('.p33-act-list li span');
                fr.activities.forEach((act, aIdx) => {
                    if (actSpans[aIdx]) actSpans[aIdx].textContent = act;
                });
            }

            const checkEl = card.querySelector('.p33-checkpoint-box .p33-box-text');
            if (checkEl && fr.checkpoint) checkEl.textContent = fr.checkpoint;

            const outEl = card.querySelector('.p33-output-box .p33-box-text');
            if (outEl && fr.output) outEl.textContent = fr.output;
        });
    }

    function applyEnglish() {
        if (!enCached) return;

        // 1. Search Input Placeholder
        const searchInput = document.getElementById('p33-search-input');
        if (searchInput) {
            searchInput.placeholder = "Search steps (e.g., laser, bending, powder coating, busbar, FAT)...";
        }

        // 2. Machine Specs & Tabs
        EN_CACHE.machines.forEach((m, idx) => {
            const nameEl = document.querySelectorAll('.eq-tab-name')[idx];
            if (nameEl && m.title) nameEl.textContent = m.title;

            const slide = document.querySelector(`.eq-panel-slide[data-panel-index="${idx}"]`);
            if (slide && m.tags) {
                const lis = slide.querySelectorAll('.eq-tags li');
                m.tags.forEach((tag, tIdx) => {
                    if (lis[tIdx]) {
                        const svg = lis[tIdx].querySelector('svg');
                        lis[tIdx].innerHTML = '';
                        if (svg) lis[tIdx].appendChild(svg);
                        lis[tIdx].appendChild(document.createTextNode(' ' + tag));
                    }
                });
            }
        });

        // 3. Phase Tabs
        EN_CACHE.phases.forEach((pTitle, idx) => {
            const tab = document.querySelector(`.p33-tab[data-phase-filter="${idx}"] span:first-child`);
            if (tab && pTitle) tab.textContent = pTitle;
        });

        // 4. Process Cards
        EN_CACHE.steps.forEach((en, idx) => {
            const card = document.querySelectorAll('.p33-card')[idx];
            if (!card) return;

            const subtitleEl = card.querySelector('.p33-step-subtitle');
            if (subtitleEl && en.subtitle) subtitleEl.textContent = en.subtitle;

            const titleEl = card.querySelector('.p33-step-title');
            if (titleEl && en.title) titleEl.textContent = en.title;

            const descEl = card.querySelector('.p33-step-desc');
            if (descEl && en.desc) descEl.textContent = en.desc;

            if (en.activities) {
                const actSpans = card.querySelectorAll('.p33-act-list li span');
                en.activities.forEach((act, aIdx) => {
                    if (actSpans[aIdx]) actSpans[aIdx].textContent = act;
                });
            }

            const checkEl = card.querySelector('.p33-checkpoint-box .p33-box-text');
            if (checkEl && en.checkpoint) checkEl.textContent = en.checkpoint;

            const outEl = card.querySelector('.p33-output-box .p33-box-text');
            if (outEl && en.output) outEl.textContent = en.output;
        });
    }

    function onLanguageUpdate(lang) {
        if (lang === 'fr') {
            applyFrench();
        } else {
            applyEnglish();
        }
    }

    window.addEventListener('atsLanguageChanged', function(e) {
        const lang = e.detail && e.detail.lang ? e.detail.lang : 'en';
        onLanguageUpdate(lang);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const initialLang = document.documentElement.getAttribute('lang') || localStorage.getItem('ats_lang_process') || 'en';
        if (initialLang === 'fr') {
            setTimeout(applyFrench, 50);
        }
    });
})();
