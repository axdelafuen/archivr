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


## soundhandler(this,src)
Doit-être ajouté à l'évènement `onclick` de l'élément. `src` correspond au chemin vers le fichier mp3 à lire. Si l'utilisateur appuis une seconde fois sur le bouton, le son s'arrête et rependra du début si il rappuie deçu. Si il appuie sur un deuxième bouton pendant qu'un audio est lancé, ça coupe le premier et lance celui sélectionné.

#### Exemple
```html

      <a-box 
      position="1 1 -4"
      color="brown"
      onclick="soundhandler(this,'./assets/dualipa.mp3')"></a-box>
```


__Projet à voir dans le repot *A-frame-training* -> *playground* dans la branche *Aurian*__
# Controle des manette :

