```plantuml
@startwbs

<style>
wbsDiagram {
  arrow {
    LineColor SkyBlue
  }
  :depth(0) {
      LineColor transparent
      FontColor transparent
  }
  arrow {
    :depth(2) {
      LineColor lightblue
    }
  } 
}
</style>
*_ wbs
**_ 1. Gestion de projet
***_ 1.1 Premier rapport
****_ 1.1.1 WBS
****_ 1.1.2 Gantt
****_ 1.1.3 PERT
****_ 1.1.4 Transcription des besoins
****_ 1.1.5 Indicateur de suivi de projet 
****_ 1.1.6 Précision des coûts
***_ 1.2 Rapport final
****_ 1.2.1 Comparaison du prévisionel et du réel
***_ 1.3 Soutenance

**_ 2. Analyse de l'existant
***_ 2.1 Prise en main de //A-frame//
****_ 2.1.1 Lecture de la documentation
****_ 2.1.2 Premiers tests
***_ 2.2 Reverse engineering
****_ 2.2.1 Lecture du rapport
****_ 2.2.2 Analyse des diagrammes
****_ 2.2.3 Analyse du code
***_ 2.3 Tests de //A-frame//

**_ 3. Réalisation de l'application
***_ 3.1 Initialisation
****_ 3.1.1 Diagrammes de cas d'utilisation
****_ 3.1.2 Diagrammes architecture
****_ 3.1.3 Diagrammes d'objets
****_ 3.1.4 POC
***_ 3.2 Développement de l'application
***_ 3.3 Développement du générateur
***_ 3.4 Mise en place d'une persistance
****_ 3.4.1 Stub
****_ 3.4.2 Base de données
***_ 3.5 Intégration / déploiement continue 
****_ 3.5.1 Compilation et tests
****_ 3.5.2 Analyse de code
****_ 3.5.3 Documentation
****_ 3.5.4 Déploiement

@endwbs
```