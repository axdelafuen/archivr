
function addSign() {
    text = window.prompt("Enter the sign content : ");
    text = text.trim();
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