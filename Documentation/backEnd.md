🚧 La balise `a-entity` qui contient la scène à affiché doit avoir l'id `base` 🚧 


# Transition entre view
Fais une transition de fade In/Out entre les éléments et les deux sky.

## animationcustom (Component)
A ajouter à TOUS les éléments visibles (sky compris)

## `goTo('pathToHTMLContent')` 
A mettre dans l'èvenement `onclick` de la flèche de direction.
Permet de changer de view, lance automatiquement les évènements pour les animations de transition.

#### Exemple: 
```html 
<a-box color="pink" position="0 1 -3" onclick="goTo()"  animationcustom class="clickable">
</a-box>
```

__Projet à voir dans le repot *A-frame-training* -> *template* dans la branche *Aurian*__


# Apparition d'éléments
permet de faire apparaitre des éléments en regardant un endroit dans l'image. Pour que cela fonctionne, il faut créer une balise `<a-plane rotation="0 90 0" opacity="0.0">` avec une opacité de 0.0 pour qu'il soit invisible. Lorsque l'utilisateur regarde vers cet éléments il déclanche l'apparition des éléments avec les évènements `onmouseenter` et `onmouseleave` quand il ne regarde plus.

## Fades (Component)
__Un nom de classe = 1 panneaux d'affichages.__   
Mets l'opacité des éléments à 0 (invisible) et l'ajoute dans la classe `.default` si aucune n'est renseignée.  
🛑 Si il y a plusieur panneaux à afficher, changez les classes 🛑 

## FadeIn('classe')/FadeOut('classe')
- FadeIn() :  
Doit-être ajoutée dans l'évènement `onmouseenter` du `a-plane`
- FadeOut() :
Doit-être ajoutée dans l'évènement `onmouleave` du `a-plane`

#### Exemple

```html 
<a-plane 
      position="1 1 -4"
      color="brown"
      rotation="0 90 0"
      opacity="0.0"
      onmouseenter="fadeIn()"
      onmouseleave="fadeOut()"
      ></a-plane>
```

__Projet à voir dans le repot *A-frame-training* -> *playground* dans la branche *Aurian*__
# Lecture de MP3
Permet de lire des fichiers mp3 lorsqu'on appuie sur un élément.



__Projet à voir dans le repot *A-frame-training* -> *playground* dans la branche *Aurian*__
# Controle des manette :


# Gestion du slider

## sliderelement (Component)
Ajoute dans le tableau `arrayViews` l'élement HTML contenant le composant. Cela permettrad'accéder au différentes temporalités.
🛑 Bien mettre dans l'ordre du plus récent au plus vieux dans le html sinon ça ne s'affichera pas dans le bon ordre. 🛑

#### Exemple
```html 
<a-entity id="base">
  <a-sky src="assets/paul-szewczyk-GfXqtWmiuDI-unsplash.jpg" id="uno" ></a-sky>
  <a-sky src="assets/timothy-oldfield-luufnHoChRU-unsplash (1).jpg" id="dos" opacity="0.0"></a-sky>
  <a-sky src="assets/kris-guico-rsB-he-ye7w-unsplash.jpg" id="tres" opacity="0.0"></a-sky>
  <a-sky src="assets/alex-bdnr-GNNoZa8zVwY-unsplash.jpg" id="cuatro" opacity="0.0"></a-sky>
</a-entity>
```

## document.addEventListener(keydown,...)

Ajoute l'évènement `keydown` (qui détecte lorsqu'une touche est appuyée et/ou maintenue) à tous le document HTML.  
Il y a une valeur minimale et maximal qui borne les valeurs du "slider". Avec les touches ⬅️ et ➡️, on peut varier l'opacité des `sky` et changer de temporalités. L'ajout avec le fonctionnement des manettes arrivera bienôt.
