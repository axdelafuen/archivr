function sliderChanged(slider, id){
    slider.parentNode.querySelector("span").innerHTML = slider.value

    output = slider.parentNode.parentNode.querySelectorAll("input")

    position = ""

    output.forEach(pos => {
        position = position + pos.value.toString() + " "
    })
    document.getElementById(id).setAttribute("position",position)

    document.getElementById("elementPositionX").setAttribute("value",document.getElementById("positionX").value.toString())
    document.getElementById("elementPositionY").setAttribute("value",document.getElementById("positionY").value.toString())
    document.getElementById("elementPositionZ").setAttribute("value",document.getElementById("positionZ").value.toString())
}
