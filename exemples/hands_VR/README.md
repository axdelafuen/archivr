# Les mains dans la réalité virtuelle

Cet exemple présente une possible implémentation avec les mains en réalité virtuelle. l'élément slider permet de créer un objet 3D avec lequel on peut intéragir directement avec.
Pour cet exemple, nous pouvons changer la couleur du ciel avec ce slider. D'autre éléments sont possible notamment le bouton map qui, pour cet exemple ne fais rien mais la logique fonctionne. Pour changer le comportement du bouton lorsqu'on le presse, il suffit de modifier la méthode `onClick` du component __event-manager__ (dans le fichier du même nom) comme ceci :  


```html
onClick: function(evt) {
    var targetEl = evt.target;
    if (targetEl === this.darkModeButtonEl) {
      // logic for map acces
      // ex :
      // goTo('plan.html')
    }
    else {
      console.log("Logic to add")
    }
}
```
