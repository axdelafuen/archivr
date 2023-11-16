function sliderChanged(slider, id){
    slider.parentNode.querySelector("span").innerHTML = slider.value

    input = slider.parentNode.parentNode.querySelectorAll("input")

    position = ""

    input.forEach(pos => {
        position = position + pos.value.toString() + " "
    })
    document.getElementById(id).setAttribute("position",position)
}
