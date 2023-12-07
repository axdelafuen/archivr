🚧 La balise `a-entity` qui contient la scène à affiché doit avoir l'id `base` 🚧 

## animationcustom (Component)
A ajouter à TOUS les éléments visibles (sky compris)

## `goTo('pathToHTMLContent','CameraRotation')` 
A mettre dans l'èvenement `onclick` de la flèche de direction.
Permet de changer de view, lance automatiquement les évènements pour les animations de transition et change l'oriantation de la caméra (set à '0 0 0' par défaut)

#### Exemple: 
```html 
<a-box color="pink" position="0 1 -3" onclick="goTo('ficher.html','8 25 0')"  animationcustom>
</a-box>
```

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
      onmouseenter="fadeIn('classeObject1')"
      onmouseleave="fadeOut('classeObject1')"
      ></a-plane>
```

__Projet à voir dans le repot *A-frame-training* -> *playground* dans la branche *Aurian*__

# Lecture de MP3
Permet de lire des fichiers mp3 lorsqu'on appuie sur un élément.


## soundhandler(this,src)
Doit-être ajouté à l'évènement `onclick` de l'élément. `src` correspond au chemin vers le fichier mp3 à lire. Si l'utilisateur appuis une seconde fois sur le bouton, le son s'arrête et rependra du début s'il rappuie deçu. Si il appuie sur un deuxième bouton pendant qu'un audio est lancé, ça coupe le premier et lance celui sélectionné.

#### Exemple
```html

      <a-box 
      position="1 1 -4"
      color="brown"
      onclick="soundhandler(this,'./assets/dualipa.mp3')"></a-box>
```


__Projet à voir dans le repot *A-frame-training* -> *playground* dans la branche *Aurian*__

# Gestion du slider

## document.addEventListener(keydown,...)

Ajoute l'évènement `keydown` (qui détecte lorsqu'une touche est appuyée et/ou maintenue) à tous le document HTML.  
Il y a une valeur minimale et maximal qui borne les valeurs du "slider". Avec les touches ⬅️ et ➡️, on peut varier l'opacité des `sky` et changer de temporalités.L'évènement, utilise les fonctions :  
- `function changeOpa2pics(value)`
- `function changeOpa3pics(value)`
- `function changeOpa4pics(value)`  
En fonction du nombre de balise contenant le composant `sliderelement`, l'évènements appelle une fonction différentes. Par exemple, s'il y a 3 temporalités différentes, alors il appellera la fonction `changeOpa3pics`.  

---

Toutes les plateformes sont supportées, pour le casque VR, l'évenement `keyDown` prend en compte le joystick __gauche__ pour le slider. Enfin, pour les smartphones, des boutons apparessent redirigeant a chacun des temporalités.

## sliderelement (Component)
Ajoute dans le tableau `arrayViews` l'élement HTML contenant le composant. Cela permettrad'accéder au différentes temporalités.
🛑 Bien mettre dans l'ordre du plus récent au plus vieux dans le html sinon ça ne s'affichera pas dans le bon ordre. 🛑  

#### Contrainte
* Pour disposé des éléments dans des temporalités différentes, il faut assignés __PAR TEMPORALITÉS__ une classe différentes a __chaque éléments__
* Les éléments que vous souhaitez montrés lorsque l'on arrive sur cette vue doivent avoir une opacité de 1.0 (par défaut), le reste des éléments doivent avoir une opacité de 0.0 (__OBLIGATOIRE__)

#### Exemple
```html 
<a-entity id="base">
  <a-sky src="assets/paul-szewczyk-GfXqtWmiuDI-unsplash.jpg" class="premiereTemporatlite" ></a-sky>
    <a-box class="premiereTemporatlite" color="purple"></a-box
  <a-sky src="assets/timothy-oldfield-luufnHoChRU-unsplash (1).jpg" classe="deuxieme" opacity="0.0"></a-sky>
    <a-box class="deuxieme" color="red"></a-box
  <a-sky src="assets/kris-guico-rsB-he-ye7w-unsplash.jpg" class="troisieme" opacity="0.0"></a-sky>
    <a-box class="troisieme" color="blue"></a-box
  <a-sky src="assets/alex-bdnr-GNNoZa8zVwY-unsplash.jpg" class="quatrieme" opacity="0.0"></a-sky>
</a-entity>
```
<u>Bouttons smartphone</u>

```html
<div class="hud" id="div">
      <button class="button-74" role="button" onclick="mobileOpacityHandler('premiereTemporatlite')"></button>
      <button class="button-74" role="button" onclick="mobileOpacityHandler('deuxieme')"></button>
      <button class="button-74" role="button" onclick="mobileOpacityHandler('troisieme')"></button>
      <button class="button-74" role="button" onclick="mobileOpacityHandler('quatrieme')"></button>
    </div>
```

# Gestion des différentes plateformes (Casque Vr, Téléphone et ordinateur)

## Scene (Component)

Permet d'inclure des fonctions, évènements et éléments en fonction du support utilisé.

#### `ComputerComponent()`
- Ajoute le panneaux indiquant les touches
- Ajoute l'évènement `enter-vr` (ajouté par __A-frame__)

#### `mobileComponent()`
- Ajoute le fichier css permettant d'afficher les boutons pour naviguer entre les temporalités (si il y en a)


# Model 3D 
Il suffit d'ajouter une balise `a-entity` et d'ajouter le composant `gltf-model='source du fichier'` (marche pour les models gltf __ET__ glb)


### Exemple
```html
<a-entity gltf-model="./assets/sign.glb" position="0 0 -1"></a-entity>
```
