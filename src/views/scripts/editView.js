
function addSign(text) {
    if (text != null) {
        newSign = document.createElement("a-entity");
        coord = {x: 0, y: 0, z: -10};
        newSign.setAttribute("position", coord);
        newSign.setAttribute("slice9", "width: 5; height: 1; left: 20; right: 43; top: 20; bottom: 43;src: views/assets/images/tooltip.png");
        newSign.setAttribute("look-at", "#cam");
        newSign.setAttribute("class", "sign");
        let value = "value:" + text + ";wrap-count:15; width:5; align:center;zOffset:0.05";
        newSign.setAttribute("text", value);
        document.getElementById("preview").appendChild(newSign);
    }
    else{
        alert("Error: text isn't correct")
    }
}

// SLIDERS TEST
/*
var slider = document.getElementById("positionX");
var output = document.getElementById("demo");
output.innerHTML = slider.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
    console.log(this.value);
    output.innerHTML = this.value;
}
*/
function sliderChanged(slider){

    slider.parentNode.querySelector("span").innerHTML = slider.value;

}