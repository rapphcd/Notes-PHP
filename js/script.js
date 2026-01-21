let selectedElement = null;

let titl = document.getElementById("title")
let desc = document.getElementById("description")

function selectNote(note) {
    let id = note.id;
    let title = note.dataset.tit;
    let description = note.dataset.desc;
    let element = document.getElementById(id)

    if (selectedElement !== element.id) {
        if (selectedElement != null) {
            let selected = document.getElementsByClassName("selected-note")[0];
            selected.classList.remove("selected-note");
        }
        element.classList.add("selected-note");
        selectedElement = element.id;

        document.getElementById("previewform").classList.remove("hidden")

        titl.value = title;
        titl._id = id

        desc.value = description
        desc._id = id
    }
}


titl.addEventListener('input', titleInput);
desc.addEventListener('input', descInput);

function titleInput(){
    var timeout = 1000;
    clearTimeout(titl._timer)
    titl._timer = setTimeout(() => {
        let elt = document.getElementById(this._id)
        elt.dataset.tit = this.value
        elt.children.item(0).children.item(0).innerHTML = this.value
        save("title", this.value, this._id)
    }, timeout);
}

function descInput(){
    var timeout = 1000;
    clearTimeout(titl._timer)
    titl._timer = setTimeout(() => {
        let elt = document.getElementById(this._id)
        elt.dataset.desc = this.value
        save("description", this.value, this._id)
    }, timeout);
}

function save(type,val, id) {
    let fd = new FormData()
    fd.append("type", type);
    fd.append("value", val);
    fd.append("id", id);
    fetch('save.php', {
        method: 'post',
        body: fd
    }).then()
}